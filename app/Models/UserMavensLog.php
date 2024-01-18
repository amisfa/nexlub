<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMavensLog extends Model
{

    protected $table = 'user_mavens_log';

    protected $fillable = [
        'user_id',
        'p_rake',
        'claim_at'
    ];
}
