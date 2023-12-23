<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInvoice extends Model
{

    protected $table = 'user_invoice';

    protected $fillable = [
        'invoice_id',
        'user_id',
        'now_payment_id',
        'invoice_token',
        'invoice_url',
        'price_amount',
        'price_currency',
        'pay_currency',
        'paid_at',
        'canceled_at',
        'dropped_at',
        'partially_paid_at',
    ];
}
