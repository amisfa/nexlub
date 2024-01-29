<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Models\User;
use App\Models\UserBadBeatReward;
use App\Models\UserJackPotReward;
use App\Models\UserRingGameStat;
use App\Models\UserSNGStat;
use Illuminate\Console\Command;

class getUserStat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-user-stat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updated User Stat';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $logs = Helper::getHistoryLog();
            if (count($logs)) {
                foreach ($logs['ring_game'] as $username => $stat) {
                    $user = User::query()->where('username', $username)->first();
                    if ($user) {
                        if ($stat['jack_pot_amount'] > 0) {
                            UserJackPotReward::query()->create([
                                'user_id' => $user->id,
                                'amount' => $stat['jack_pot_amount']
                            ]);
                        }
                        if ($stat['bad_beat_amount']) {
                            UserBadBeatReward::query()->create([
                                'user_id' => $user->id,
                                'amount' => $stat['bad_beat_amount']
                            ]);
                        }
                        if ($user->ringGameStats()->exists()) {
                            $userCashGameStat = UserRingGameStat::query()->where('user_id', $user->id);
                            $currentCashGameStat = $userCashGameStat->first();
                            $userCashGameStat->update(
                                [
                                    "total_net" => $currentCashGameStat->total_net + $stat['total_net'],
                                    "hand_count" => $currentCashGameStat->hand_count + $stat['hand_count'],
                                    "win_count" => $currentCashGameStat->win_count + $stat['win_count'],
                                    "lose_count" => $currentCashGameStat->lose_count + $stat['lose_count'],
                                    "total_lose_amount" => $currentCashGameStat->total_lose_amount + $stat['lose_amount'],
                                    "total_win_amount" => $currentCashGameStat->total_win_amount + $stat['win_amount'],
                                    "folded_on_preflop_count" => $currentCashGameStat->folded_on_preflop_count + $stat['folded_on_preflop_count'],
                                    "won_without_showdown_count" => $currentCashGameStat->won_without_showdown_count + $stat['won_without_showdown_count'],
                                    "showdown_count" => $currentCashGameStat->showdown_count + $stat['showdown_count'],
                                    "folded_on_river_count" => $currentCashGameStat->folded_on_river_count + $stat['folded_on_river_count'],
                                    "folded_on_flop_count" => $currentCashGameStat->folded_on_flop_count + $stat['folded_on_flop_count'],
                                    "folded_on_turn_count" => $currentCashGameStat->folded_on_turn_count + $stat['folded_on_turn_count'],
                                    "total_jack_pot_amount" => $currentCashGameStat->total_jack_pot_amount + $stat['jack_pot_amount'],
                                    "total_bad_beat_amount" => $currentCashGameStat->total_bad_beat_amount + $stat['bad_beat_amount'],

                                ]);
                        } else {
                            UserRingGameStat::query()->create([
                                'user_id' => $user->id,
                                "total_net" => $stat['total_net'],
                                "hand_count" => $stat['hand_count'],
                                "win_count" => $stat['win_count'],
                                "lose_count" => $stat['lose_count'],
                                "total_lose_amount" => $stat['lose_amount'],
                                "total_win_amount" => $stat['win_amount'],
                                "folded_on_preflop_count" => $stat['folded_on_preflop_count'],
                                "won_without_showdown_count" => $stat['won_without_showdown_count'],
                                "showdown_count" => $stat['showdown_count'],
                                "folded_on_river_count" => $stat['folded_on_river_count'],
                                "folded_on_flop_count" => $stat['folded_on_flop_count'],
                                "folded_on_turn_count" => $stat['folded_on_turn_count'],
                                "total_jack_pot_amount" => $stat['jack_pot_amount'],
                                "total_bad_beat_amount" => $stat['bad_beat_amount'],
                            ]);
                        }
                    }
                }
                foreach ($logs['sng'] as $username => $stat) {
                    $user = User::query()->where('username', $username)->first();
                    if ($user) {
                        if ($user->sngStats()->exists()) {
                            $userSngStat = UserSNGStat::query()->where('user_id', $user->id);
                            $currentSngStat = $userSngStat->first();
                            $userSngStat->update([
                                [
                                    "win_count" => $currentSngStat->win_count + $stat['win_count'],
                                    "lose_count" => $currentSngStat->lose_count + $stat['lose_count'],
                                    "net_chip" => $currentSngStat->total_net_chip + $stat['net_chip'],
                                ]
                            ]);
                        } else {
                            UserSNGStat::query()->create([
                                'user_id' => $user->id,
                                "win_count" => $stat['win_count'],
                                "lose_count" => $stat['lose_count'],
                                "net_chip" => $stat['net_chip'],
                            ]);
                        }
                    }
                }
            }
        } catch (\Exception $exception) {
            report($exception);
            $this->error('Updating User Stat Failed!');
        }
    }
}
