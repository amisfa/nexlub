<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserRakeLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class getUserRake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-user-rake';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updated User Rake Log';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $params = [
                "Command" => "AccountsList",
                'Fields' => "Player,Balance,PRake,PWHash",
                'Password' => env('MAVENS_PW'),
                'JSON' => 'YES'
            ];
            $response = Http::asForm()->post(env("MAVENS_URL") . '/api', $params);
            $response = json_decode($response->body(), true);
            if ($response['Result'] !== 'Ok') return;
            $query = UserRakeLog::query();
            foreach ($response['Player'] as $key => $item) {
                $user = User::query()->where('username', $item)->first();
                $hasLog = $query->where('user_id', $user->id)->first();
                if ($hasLog && $user) {
                    $query->where('user_id', $user->id)->update([
                        'rake' => $response['PRake'][$key],
                        'updated_at' => now()
                    ]);
                } else {
                    $query->create([
                        'user_id' => $user->id,
                        'rake' => $response['PRake'][$key],
                        'claimed_rake_back' => 0,
                        'claimed_rake_affiliate' => 0
                    ]);
                }
            }
        } catch (\Exception $exception) {
            report($exception);
            $this->error('Updating User Rake Log Failed!');
        }
    }
}
