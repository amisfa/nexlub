<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRingGameStat extends Model
{
    use SoftDeletes;

    protected $table = 'user_ring_game_stat';

    protected $fillable = [
        'user_id',
        "total_net",
        "hand_count",
        "win_count",
        "lose_count",
        "folded_on_preflop_count",
        "won_without_showdown_count",
        "showdown_count",
        "folded_on_river_count",
        "folded_on_flop_count",
        "folded_on_turn_count",
        "total_bad_beat_amount",
        "total_jack_pot_amount",
    ];
}
