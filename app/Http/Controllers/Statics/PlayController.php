<?php

namespace App\Http\Controllers\Statics;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PlayController extends Controller
{
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $userName = auth()->user()->username;
        $response = Helper::setPokerMavens(["Command" => "AccountsSessionKey", "Player" => $userName]);
        $sessionKey = $response['SessionKey'];
        return view('pages.play', ['url' => env('MAVENS_URL') . "/?LoginName=" . $userName . "&SessionKey=" . $sessionKey]);
    }
}
