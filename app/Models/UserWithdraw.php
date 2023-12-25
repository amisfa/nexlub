<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserWithdraw extends Model
{
    use HasFactory;

    protected $table = 'user_invoice';

    protected $fillable = [
        'user_id',
        'paid_address',
        'amount',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}
