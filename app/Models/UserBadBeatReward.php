<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBadBeatReward extends Model
{
    use SoftDeletes;

    protected $table = 'user_bad_beat_reward';

    protected $fillable = [
        'user_id',
        "amount",
        "claimed_at"
    ];
}
