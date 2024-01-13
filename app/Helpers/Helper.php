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

    static function getAvailableCurrencies($getCIId = false): array
    {
        $response = Http::get('https://plisio.net/api/v1/currencies', ['api_key' => env('PILISIO_SECRET_KEY'), 'hidden' => true]);
        if ($response->status() !== 200) return [];
        $currencies = json_decode($response->body(), true);
        return array_map(function ($coin) use ($getCIId) {
            return ['currency' => $getCIId ? $coin['cid'] : $coin['currency'], 'name' => $coin['name'], 'icon' => $coin['icon']];
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
