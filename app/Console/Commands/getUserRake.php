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
            foreach ($response['Player'] as $key => $item) {
                $query = UserRakeLog::query();
                $user = User::query()->where('username', $item)->first();
                $pureRake = $response['PRake'][$key];
                $level = 1;
                if (UserRakeLog::query()->where('user_id', $user->id)->exists()) {
                    switch ($pureRake) {
                        case $pureRake >= 100 && $pureRake < 500:
                            $level = 2;
                            break;
                        case $pureRake >= 500 && $pureRake < 1000:
                            $level = 3;
                            break;
                        case $pureRake >= 1000 && $pureRake < 5000:
                            $level = 4;
                            break;
                        case $pureRake >= 5000 && $pureRake < 10000:
                            $level = 5;
                            break;
                        case $pureRake >= 10000 && $pureRake < 20000:
                            $level = 6;
                            break;
                        case $pureRake >= 20000 && $pureRake < 100000:
                            $level = 7;
                            break;
                        case $pureRake >= 100000 && $pureRake < 500000:
                            $level = 8;
                            break;
                        case $pureRake >= 500000 && $pureRake < 1000000:
                            $level = 9;
                            break;
                        case $pureRake >= 1000000:
                            $level = 10;
                            break;
                    }
                    if ($level != 1) {
                        $user->level = $level;
                        $user->save();
                    }
                    $query->where('user_id', $user->id)->update([
                        'rake' => $pureRake,
                        'updated_at' => now()
                    ]);
                } else {
                    $query->create([
                        'user_id' => $user->id,
                        'rake' => $pureRake,
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
