<?php

namespace App\Models;

use App\Enums\WithdrawStatuses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserWithdraw extends Model
{
    use SoftDeletes;

    protected $table = 'user_withdraw';
    protected $casts = [
        'status' => WithdrawStatuses::class,
    ];

    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'tx_url',
        'rejected_comment',
        'currency'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}
