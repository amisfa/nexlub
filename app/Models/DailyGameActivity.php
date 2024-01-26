<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyGameActivity extends Model
{

    protected $table = 'daily_game_activities';

    protected $fillable = [
        'username',
        'most_hand',
        'bad_beat',
        'jack_pot',
        'most_win',
        'most_lose'
    ];
}
