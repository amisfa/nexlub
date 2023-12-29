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
        $response = json_decode($response);
        if ($response->Result !== 'Ok') return back()->withErrors(['error' => $response->Error]);
        return $response;
    }

    static function getAvailableCurrencies()
    {
        $response = Http::withHeaders([
            'x-api-key' => env('NOWPAYMENTS_API_KEY'),
        ])->get('https://api.nowpayments.io/v1/currencies?fixed_rate=true');
        if ($response->status() !== 200) return [];
        $selectedCurrencies = [
            "btc",
            "bnbbsc",
            "usdttrc20",
            "usdterc20",
            "usdc",
            "usdtbsc",
            "usdcmatic",
            "usdtmatic",
            "usdtarb",
            "usdcarc20",
            "usdcop",
            "usdcsol",
            "usdtop",
            "busd",
            "usdcbsc",
            "eth",
            "ltc",
            "trx",
            "usdtsol"
        ];
        $currencies = json_decode($response->body(), true)['currencies'];
        foreach ($currencies as $key => $currency) {
            if (!in_array($currency['currency'], $selectedCurrencies)) unset($currencies[$key]);
        }
        return array_reverse($currencies);
    }

    static function createInvoice($params)
    {
        return Http::asForm()->withHeaders([
            'x-api-key' => env('NOWPAYMENTS_API_KEY'),
            'Content-Type' => 'application/json'
        ])->post('https://api.nowpayments.io/v1/invoice', $params);
    }

    static function getEstimatedPrice($params): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return Http::asForm()->withHeaders([
            'x-api-key' => env('NOWPAYMENTS_API_KEY'),
            'Content-Type' => 'application/json'
        ])->get('https://api.nowpayments.io/v1/estimate', $params);
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
        User::query()->update(['balance' => intval($user->balance) + intval($params['amount'])]);
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
        User::query()->update(['balance' => intval($user->balance) - intval($params['amount'])]);
    }

    static function sendValidationEmail($user): void
    {
        $token = Str::random(64);
        UserVerify::query()->create(['user_id' => $user->id, 'token' => $token])->save();
        Mail::to($user->email)->send(new VerifyEmail($token, $user));
    }
}
