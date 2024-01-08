<?php

namespace App\Models;

use App\Enums\CashOutStatuses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCashOut extends Model
{
    use SoftDeletes;

    protected $table = 'user_cash_out';

    protected $fillable = [
        'user_id',
        'amount',
        'status'
    ];
    protected $casts = [
        'status' => CashOutStatuses::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
