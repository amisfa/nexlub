<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInvoice extends Model
{

    protected $table = 'user_invoice';

    protected $fillable = [
        'invoice_id',
        'user_id',
        'invoice_url',
        'price_amount',
        'price_currency',
        'pay_currency',
    ];
}
