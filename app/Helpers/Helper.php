<?php

namespace App\Helpers;

use App\Mail\VerifyEmail;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Helper
{
    static function setPokerMavens($params)
    {
        $params['Password'] = env('MAVENS_PW');
        $params['JSON'] = 'Yes';
        $response = Http::asForm()->post(env("MAVENS_URL") . '/api', $params);
        $response = json_decode($response->body(), true);
        if ($response['Result'] !== 'Ok') return back()->withErrors(['error' => $response['Error']]);
        return $response;
    }


    static function getHistoryLog()
    {
        $params['Password'] = env('MAVENS_PW');
        $params['JSON'] = 'Yes';
        $params['Date'] = now()->format('Y-m-d');
        $params['Command'] = 'LogsHandHistory';
        $dailyTableHistories = [];
        $dailyRingGameActivities = [];
        $dailySNGActivity = [];
        $logs = [];
        $response = json_decode(Http::asForm()->post(env("MAVENS_URL") . '/api', $params)->body(), true);
        if ($response['Result'] !== 'Error') {
            $tableNames = $response['Name'];
            foreach ($tableNames as $name) {
                $params['Name'] = $name;
                $response = json_decode(Http::asForm()->post(env("MAVENS_URL") . '/api', $params)->body());
                if ($response->Result !== 'Error') {
                    $pseudoHand = [];
                    $pseudoData = [];
                    foreach ($response->Data as $key => $item) {
                        if (str_contains($item, "Hand") && str_contains($item, now()->format('Y-m-d'))) {
                            $pseudoHand['started_from'] = $key;
                        };
                        if (isset($pseudoHand['started_from'])) {
                            foreach ($response->Data as $key2 => $item2) {
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
                                $pseudoData[] = $response->Data[$x];
                            }
                            $pseudoHand = [];
                        }
                        if (count($pseudoData)) {
                            $dailyTableHistories[$name][] = $pseudoData;
                            $pseudoData = [];
                        }
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
                                        'daily_balance' => 0,
                                        'hand_count' => 0,
                                        'jack_pot_amount' => 0,
                                        'bad_beat_amount' => 0,
                                    ];
                                    preg_match("/(?<=\()(.+)(?=\))/is", $userSeat, $matches);
                                    $balance = $matches[0];
                                    $dailyRingGameActivities[$userName]['daily_balance'] += floatval($balance);
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
        }
        return $logs;
    }

    static function getAvailableCurrencies(): array
    {
        $response = Http::get('https://plisio.net/api/v1/currencies', ['api_key' => env('PILISIO_SECRET_KEY'), 'hidden' => true]);
        if ($response->status() !== 200) return [];
        $currencies = json_decode($response->body(), true);
        $minAmount = [
            'BTC' => 100,
        ];
        return array_map(function ($coin) use ($minAmount) {
            return [
                'currency' => $coin['cid'],
                'name' => $coin['name'],
                'icon' => $coin['icon'],
                'min_amount' => isset($minAmount[$coin['cid']]) ? $minAmount[$coin['cid']] : 30
            ];
        }, $currencies['data']);
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
        User::query()->update(['balance' => $user->balance + $params['amount']]);
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
        User::query()->update(['balance' => $user->balance - $params['amount']]);
    }

    static function sendValidationEmail($user): void
    {
        $token = Str::random(64);
        UserVerify::query()->create(['user_id' => $user->id, 'token' => $token])->save();
        Mail::to($user->email)->send(new VerifyEmail($token, $user));
    }

    public function getWalletBalance(): array
    {
        $url = 'https://plisio.net/api/v1/balances/' . request('currencyId');
        $response = Http::get($url, ['api_key' => env('PILISIO_SECRET_KEY')]);
        if ($response->status() !== 200) return [];
        $currencies = json_decode($response->body(), true);
        return $currencies['data'];
    }
}
