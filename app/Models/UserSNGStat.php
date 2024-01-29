<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSNGStat extends Model
{
    use SoftDeletes;

    protected $table = 'user_sng_game_stat';

    protected $fillable = [
        'user_id',
        "win_count",
        "lose_count",
        "total_net_chip",
    ];
}
