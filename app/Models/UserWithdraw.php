<?php

namespace App\Models;

use App\Enums\CashOutStatuses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserWithdraw extends Model
{
    use HasFactory;

    protected $table = 'user_withdraw';

    protected $fillable = [
        'user_id',
        'amount',
        'status',
    ];
    protected $casts = [
        'status' => CashOutStatuses::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}
