<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRakeLog extends Model
{

    protected $table = 'user_rake_log';

    protected $fillable = [
        'user_id',
        'rake',
        'claimed_rake_back',
        'claimed_rake_affiliate',
        'claim_at'
    ];
    protected $appends = [
        'affiliate_rake',
        'user_rake_back'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAffiliateRakeAttribute(): float|int
    {
        return ($this->user->affiliate_rake_percentage / 100) * $this->rake;
    }

    public function getUserRakeBackAttribute(): float|int
    {
        return ($this->user->rake_back_percentage / 100) * $this->rake;
    }
}
