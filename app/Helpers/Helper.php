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
}
