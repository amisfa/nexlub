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
                $currentLevel = $user->level;
                $level = 0;
                if (UserRakeLog::query()->where('user_id', $user->id)->exists()) {
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
                if ($pureRake >= 100 && $pureRake < 500) $level = 2;
                if ($pureRake >= 500 && $pureRake < 1000) $level = 3;
                if ($pureRake >= 1000 && $pureRake < 5000) $level = 4;
                if ($pureRake >= 5000 && $pureRake < 10000) $level = 5;
                if ($pureRake >= 10000 && $pureRake < 20000) $level = 6;
                if ($pureRake >= 20000 && $pureRake < 100000) $level = 7;
                if ($pureRake >= 100000 && $pureRake < 500000) $level = 8;
                if ($pureRake >= 500000 && $pureRake < 1000000) $level = 9;
                if ($pureRake >= 1000000) $level = 10;
                if($level !== 0 ){
                    if ($level !== $currentLevel) {
                        $remainRakeBack = $user->remain_rake_back;
                        $userRakeLogQuery = $user->userRake();
                        $rakeBackPercentage = 0;
                        switch ($level) {
                            case 1:
                                $rakeBackPercentage = 5;
                                break;
                            case 2:
                                $rakeBackPercentage = 7;
                                break;
                            case 3:
                                $rakeBackPercentage = 10;
                                break;
                            case 4:
                                $rakeBackPercentage = 15;
                                break;
                            case 5:
                                $rakeBackPercentage = 20;
                                break;
                            case 6:
                                $rakeBackPercentage = 25;
                                break;
                            case 7:
                                $rakeBackPercentage = 30;
                                break;
                            case 8:
                                $rakeBackPercentage = 35;
                                break;
                            case 9:
                                $rakeBackPercentage = 40;
                                break;
                            case 10:
                                $rakeBackPercentage = 45;
                                break;
                        }
                        $userRakeLogQuery->update([
                            'claimed_rake_back' => (($rakeBackPercentage / 100) * $user->userRake->rake) - $remainRakeBack
                        ]);
                    }
                    $user->level = $level;
                    $user->save();
                }
            }
        } catch (\Exception $exception) {
            report($exception);
            $this->error('Updating User Rake Log Failed!');
        }
    }
}
