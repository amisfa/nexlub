<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class Helper
{
    static function setPokerMavens($params)
    {
        $params['Password'] = env('MAVENS_PW');
        $params['JSON'] = 'Yes';
        $response = Http::asForm()->post(env("MAVENS_URL") . '/api', $params);
        $response = json_decode($response);
        if ($response->Result !== 'Ok') return $response->Error;
        return $response;
    }

    static function getAvailableCurrencies()
    {
        return Http::retry(3, 100, throw: false)->withHeaders([
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache',
            'User-Agent' => 'PostmanRuntime/7.36.0',
            'Accept' => '*/*',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Connection' => 'keep-alive',
        ])->get('https://api.nowpayments.io/v1/status');
    }

    static function createPayment($params)
    {
        return Http::asForm()->withHeaders([
            'x-api-key' => env('NOWPAYMENTS_API_KEY'),
            'Content-Type' => 'application/json'
        ])->post('https://api.nowpayments.io/v1/payment', $params);
    }
}
