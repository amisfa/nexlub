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


    static function getEventLogs()
    {
        $params['Password'] = env('MAVENS_PW');
        $params['JSON'] = 'Yes';
        $params['Date'] = now()->format('Y-m-d');
        $params['Command'] = 'LogsHandHistory';
        $dailyHandHistories = [];
        $response = Http::asForm()->post(env("MAVENS_URL") . '/api', $params)->body();
        $tableNames = json_decode($response, true)['Name'];
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
                            };
                        }
                    }
                    if (isset($pseudoHand['started_from']) && isset($pseudoHand['ended_in'])) {
                        for ($x = $pseudoHand['started_from']; $x <= $pseudoHand['ended_in']; $x++) {
                            $pseudoData[] = $response->Data[$x];
                        }
                        $pseudoHand = [];
                    }
                    if (count($pseudoData)) {
                        if (str_contains($response->Data[0], 'Starting tournament')) {
                            $pseudoData['is_tour'] = true;
                        }
                        $dailyHandHistories[$name][] = $pseudoData;
                        $pseudoData = [];
                    }
                }
            }
        }
        if (count($dailyHandHistories)) {
            $dailyActivities = [];
            foreach ($dailyHandHistories as $tableName => $tableData) {
                if (!str_contains($tableName, "TRN")) {
                    foreach ($tableData as $hand) {
                        $summaryKey = array_search('** Summary **', $hand);
                        $summary = array_slice($hand, $summaryKey);
                        unset($summary[0]);
                        unset($summary[1]);
                        $userSeats = array_values($summary);
                        foreach ($userSeats as $userSeat) {
                            $matches = explode(":", $userSeat);
                            $userName =  str_replace(' ', '', explode(' (', $matches[1])[0]);
//                            $dailyActivities[$userName]
                            dd($userName);
                        }
                        dd($dailyActivities);
                    }
                }
            }
        }
        return $response;

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
