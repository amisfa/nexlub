<?php

namespace App\Helpers;

use App\Mail\VerifyEmail;
use App\Models\User;
use App\Models\UserBadBeatReward;
use App\Models\UserJackPotReward;
use App\Models\UserRingGameStat;
use App\Models\UserSNGStat;
use App\Models\UserVerify;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Helper
{
    public function setMavensData(): void
    {
        if (request('Event') == 'Balance')
            User::query()->where('username', request('Player'))->update(['balance' => floatval(request('Balance'))]);
        elseif (request('Event') == 'Hand') {
            $handName = request('Hand');
            $tableName = request('Name');
            $logs = Helper::getHistoryLog($handName, $tableName);
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
        }
    }

    static function setPokerMavens($params)
    {
        $params['Password'] = env('MAVENS_PW');
        $params['JSON'] = 'Yes';
        $response = Http::asForm()->post(env("MAVENS_URL") . '/api', $params);
        $response = json_decode($response->body(), true);
        if ($response['Result'] !== 'Ok') return back()->withErrors(['error' => $response['Error']]);
        return $response;
    }

    static function getHistoryLog($handName = null, $table = null): array
    {
        $params['Password'] = env('MAVENS_PW');
        $params['JSON'] = 'Yes';
        $params['Command'] = 'LogsHandHistory';
        if ($handName) $params['Hand'] = $handName;
        $dailyTableHistories = [];
        $dailyRingGameActivities = [];
        $dailySNGActivity = [];
        $logs = [];
        $response = json_decode(Http::asForm()->post(env("MAVENS_URL") . '/api', $params)->body(), true);
        if ($response['Result'] !== 'Error') {
            $pseudoHand = [];
            $pseudoData = [];
            foreach ($response['Data'] as $key => $item) {
                if (str_contains($item, "Hand") && str_contains($item, now()->format('Y-m-d'))) {
                    $pseudoHand['started_from'] = $key;
                };
                if (isset($pseudoHand['started_from'])) {
                    foreach ($response['Data'] as $key2 => $item2) {
                        if ($item2 === "" &&
                            $pseudoHand['started_from'] < $key2
                            && !isset($pseudoHand['ended_in'])
                        ) {
                            $pseudoHand['ended_in'] = $key2 - 1;
                        }
                    }
                }
                if (isset($pseudoHand['started_from']) && isset($pseudoHand['ended_in'])) {
                    for ($x = $pseudoHand['started_from']; $x <= $pseudoHand['ended_in']; $x++) {
                        $pseudoData[] = $response['Data'][$x];
                    }
                    $pseudoHand = [];
                }
                if (count($pseudoData)) {
                    $dailyTableHistories[$table][] = $pseudoData;
                    $pseudoData = [];
                }
            }
        }
        if (count($dailyTableHistories)) {
            foreach ($dailyTableHistories as $tableName => $tableData) {
                if (!str_contains($tableName, "TRN")) {
                    foreach ($tableData as $hand) {
                        if (!str_contains($tableName, 'SnG')) {
                            $summaryKey = array_search('** Summary **', $hand);
                            $summary = array_slice($hand, $summaryKey);
                            preg_match('/ Total: .*, /', $summary[1], $matches);
                            $pot = str_replace(' Total: ', '', substr($matches[0], 0, strpos($matches[0], ', Rake:')));
                            unset($summary[0]);
                            unset($summary[1]);
                            $userSeats = array_values($summary);
                            foreach ($userSeats as $userSeat) {
                                $matches = explode(":", $userSeat);
                                $userName = str_replace(' ', '', explode(' (', $matches[1])[0]);
                                if (!isset($dailyRingGameActivities[$userName])) $dailyRingGameActivities[$userName] = [
                                    'total_net' => 0,
                                    'hand_count' => 0,
                                    'win_count' => 0,
                                    'lose_count' => 0,
                                    'folded_on_preflop_count' => 0,
                                    'won_without_showdown_count' => 0,
                                    'showdown_count' => 0,
                                    'folded_on_river_count' => 0,
                                    'folded_on_flop_count' => 0,
                                    'folded_on_turn_count' => 0,
                                    'jack_pot_amount' => 0,
                                    'bad_beat_amount' => 0,
                                ];
                                preg_match("/(?<=\()(.+)(?=\))/is", $userSeat, $matches);
                                $balance = $matches[0];
                                if (floatval($balance) < 0) {
                                    $dailyRingGameActivities[$userName]['lose_count'] += 1;
                                }
                                if (floatval($balance) > 0) {
                                    $dailyRingGameActivities[$userName]['win_count'] += 1;
                                }
                                if (str_contains($userSeat, 'Folded on PreFlop')) {
                                    $dailyRingGameActivities[$userName]['folded_on_preflop_count'] += 1;
                                }
                                if (str_contains($userSeat, 'Won without Showdown')) {
                                    $dailyRingGameActivities[$userName]['won_without_showdown_count'] += 1;
                                }
                                if (str_contains($userSeat, 'Showdown with') || !str_contains($userSeat, 'Folded')) {
                                    $dailyRingGameActivities[$userName]['showdown_count'] += 1;
                                }
                                if (str_contains($userSeat, 'Folded on River')) {
                                    $dailyRingGameActivities[$userName]['folded_on_river_count'] += 1;
                                }
                                if (str_contains($userSeat, 'Folded on Flop')) {
                                    $dailyRingGameActivities[$userName]['folded_on_flop_count'] += 1;
                                }
                                if (str_contains($userSeat, 'Folded on Turn')) {
                                    $dailyRingGameActivities[$userName]['folded_on_turn_count'] += 1;
                                }
                                $dailyRingGameActivities[$userName]['total_net'] += floatval($balance);
                                $dailyRingGameActivities[$userName]['hand_count'] += 1;
                                if (str_contains($userSeat, 'Showdown with a Royal Flush')) {
                                    $badBeatWinners = array_filter($userSeats, function ($x) {
                                        return str_contains($x, "Four of a Kind");
                                    });
                                    if (count($badBeatWinners)) {
                                        foreach ($badBeatWinners as $badBeatWinner) {
                                            $matches = explode(":", $badBeatWinner);
                                            $badBeatWinnerName = str_replace(' ', '', explode(' (', $matches[1])[0]);
                                            $dailyRingGameActivities[$badBeatWinnerName]['bad_beat_amount'] += (25 / 100) * $pot;
                                        }
                                    }
                                    $dailyRingGameActivities[$userName]['jack_pot_amount'] += (25 / 100) * $pot;
                                }
                            }
                        } else {
                            $isLastHand = false;
                            array_walk($hand, function ($value) use (&$isLastHand) {
                                if (str_contains($value, 'finishes tournament in place #1 and wins')) $isLastHand = true;
                            });
                            if ($isLastHand) {
                                $sngFee = array_values(array_filter($hand, function ($h) {
                                    return str_contains($h, 'Game: ');
                                }));
                                preg_match("/(?<=\()(.+)(?=\))/is", $sngFee[0], $matches);
                                $sngFee = str_replace("$0+", '', $matches[0]);
                                $winner = array_values(array_filter($hand, function ($h) {
                                    return str_contains($h, ' finishes tournament in place #1 and wins ');
                                }));
                                $winnerName = substr($winner[0], 0, strpos($winner[0], ' '));
                                $winnerPrize = str_replace('$', '', substr($winner[0], strpos($winner[0], '$'), strlen($winner[0])));
                                $secondPlace = array_values(array_filter($hand, function ($h) {
                                    return str_contains($h, ' finishes tournament in place #2');
                                }));
                                $thirdPlace = array_values(array_filter($hand, function ($h) {
                                    return str_contains($h, ' finishes tournament in place #3');
                                }));
                                $secondPlaceName = str_replace(' finishes tournament in place #2', '', $secondPlace[0]);
                                $thirdPlaceName = count($thirdPlace) ? str_replace(' finishes tournament in place #3', '', $thirdPlace[0]) : null;
                                if (
                                    !isset($dailySNGActivity[$winnerName]) ||
                                    !isset($dailySNGActivity[$secondPlaceName]) ||
                                    ($thirdPlaceName && !isset($dailySNGActivity[$thirdPlaceName]))
                                ) {
                                    $dailySNGActivity[$winnerName] = [
                                        'win_count' => 0,
                                        'lose_count' => 0,
                                        'net_chip' => 0,
                                    ];
                                    $dailySNGActivity[$secondPlaceName] = [
                                        'win_count' => 0,
                                        'lose_count' => 0,
                                        'net_chip' => 0,
                                    ];
                                    if ($thirdPlaceName)
                                        $dailySNGActivity[$thirdPlaceName] = [
                                            'win_count' => 0,
                                            'lose_count' => 0,
                                            'net_chip' => 0,
                                        ];
                                }
                                $dailySNGActivity[$winnerName]['win_count'] += 1;
                                $dailySNGActivity[$winnerName]['net_chip'] += $winnerPrize - $sngFee;
                                $dailySNGActivity[$secondPlaceName]['lose_count'] += 1;
                                $dailySNGActivity[$secondPlaceName]['net_chip'] += -$sngFee;
                                if ($thirdPlaceName) {
                                    $dailySNGActivity[$thirdPlaceName]['lose_count'] += 1;
                                    $dailySNGActivity[$thirdPlaceName]['net_chip'] += -$sngFee;
                                }
                            }
                        }
                    }
                }
            }
        }
        if (count($dailyRingGameActivities) || count($dailySNGActivity)) {
            $logs['ring_game'] = $dailyRingGameActivities;
            $logs['sng'] = $dailySNGActivity;
        }
        return $logs;
    }

    static function getAvailableCurrencies(): array
    {
        $response = Http::get('https://plisio.net/api/v1/currencies/USD', ['api_key' => env('PILISIO_SECRET_KEY')]);
        if ($response->status() !== 200) return [];
        $currencies = json_decode($response->body(), true);
        $minAmount = [
            'BTC' => 100,
            'ETH' => 30
        ];
        return array_map(function ($coin) use ($minAmount) {
            return [
                'currency' => $coin['cid'],
                'rate_usd' => $coin['rate_usd'],
                'name' => $coin['name'],
                'icon' => $coin['icon'],
                'min_amount' => isset($minAmount[$coin['cid']]) ? $minAmount[$coin['cid']] : 10
            ];
        }, array_filter($currencies['data'], function ($coin) {
            if (!$coin['hidden']) return $coin;
        }));
    }

    static function createInvoice($params): \Illuminate\Http\Client\Response
    {
        $params['api_key'] = env('PILISIO_SECRET_KEY');
        return Http::get('https://plisio.net/api/v1/invoices/new', $params);
    }

    static function addBalance($params): void
    {
        $user = User::query()->find($params['user_id']);
        Helper::setPokerMavens([
            "Command" => "AccountsIncBalance",
            'Player' => $user->username,
            'Amount' => $params['amount']
        ]);
        Helper::setPokerMavens([
            'Command' => 'LogsAddEvent',
            'Log' => $params['log']
        ]);
        $user->balance = $user->balance + $params['amount'];
        $user->save();
    }

    static function decBalance($params): void
    {
        $user = User::query()->find($params['user_id']);
        Helper::setPokerMavens([
            "Command" => "AccountsDecBalance",
            'Player' => $user->username,
            'Negative' => 'Skip',
            'Amount' => $params['amount']
        ]);
        Helper::setPokerMavens([
            'Command' => 'LogsAddEvent',
            'Log' => $params['log']
        ]);
        $user->balance = $user->balance - $params['amount'];
        $user->save();
    }

    static function sendValidationEmail($user): void
    {
        $token = Str::random(64);
        UserVerify::query()->create(['user_id' => $user->id, 'token' => $token])->save();
        Mail::to($user->email)->send(new VerifyEmail($token, $user));
    }

    public
    function getWalletBalance(): array
    {
        $url = 'https://plisio.net/api/v1/balances/' . request('currencyId');
        $response = Http::get($url, ['api_key' => env('PILISIO_SECRET_KEY')]);
        if ($response->status() !== 200) return [];
        $currencies = json_decode($response->body(), true);
        return $currencies['data'];
    }
}
