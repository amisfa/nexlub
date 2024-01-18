<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRakeLog extends Model
{

    protected $table = 'user_rake_log';

    protected $fillable = [
        'user_id',
        'p_rake',
        'claim_at'
    ];


    public function user(): BelongsTo
    {
        $this->belongsTo(User::class, 'user_id');
    }
}
