<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPayment extends Model
{

    protected $table = 'user_payment';

    protected $fillable = [
        'user_id',
        'price_amount',
        'price_currency',
        'pay_currency',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
