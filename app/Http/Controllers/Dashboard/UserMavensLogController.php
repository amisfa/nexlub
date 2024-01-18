<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Models\User;
use App\Models\UserMavensLog;
use Illuminate\Routing\Controller;


class UserMavensLogController extends Controller
{
    public static function getData()
    {
        $response = Helper::setPokerMavens([
            "Command" => "AccountsList",
            'Fields' => "Player,Balance,PRake,PWHash"
        ]);
        dd($response);
        $query = UserMavensLog::query();
        foreach ($response['Player'] as $key => $item) {
            $user = User::query()->where('username', $item)->first();
            $hasLog = $query->where('user_id', $user->id)->first();
            if ($hasLog && $user) {
                $query->where('user_id', $user->id)->update([
                    'p_rake' => $response['PRake'][$key]
                ]);
            } else {
                $query->create([
                    'user_id' => $user->id,
                    'p_rake' => $response['PRake'][$key]
                ]);
            }
        }
    }
}
