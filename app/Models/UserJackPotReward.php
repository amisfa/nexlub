<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserJackPotReward extends Model
{
    use SoftDeletes;

    protected $table = 'user_jack_pot_reward';

    protected $fillable = [
        'user_id',
        "amount",
        "claimed_at"
    ];
}
