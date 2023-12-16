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

//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => 'https://api.nowpayments.io/v1/status',
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'GET',
//            CURLOPT_SSL_VERIFYPEER => false,
//            CURLOPT_CONNECTTIMEOUT => 0
//        ));
//        curl_setopt($curl, CURLOPT_HTTPHEADER, [
//            'Cache-Control: no-cache',
//            'User-Agent: PostmanRuntime/7.36.0',
//            'Accept: */*',
//            'Accept-Encoding: gzip, deflate, br',
//            'Connection: keep-alive',
//        ]);
//
//        set_time_limit(0);
//        ignore_user_abort(true);
//        $response = curl_exec($curl);
//
//        curl_close($curl);
//        if (!$response || curl_errno($curl) !== CURLE_OK) {
//            return 'cURL error (' . curl_errno($curl) . '): ' . curl_error($curl);
//        }
//        dd($response);
    }

    static function createPayment($params)
    {
        return Http::asForm()->withHeaders([
            'x-api-key' => env('NOWPAYMENTS_API_KEY'),
            'Content-Type' => 'application/json'
        ])->post('https://api.nowpayments.io/v1/payment', $params);
    }
}
