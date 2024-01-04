<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInvoice extends Model
{

    protected $table = 'user_invoice';

    protected $fillable = [
        'invoice_id',
        'user_id',
        'plisio_id',
        'invoice_token',
        'invoice_url',
        'price_amount',
        'paid_at',
        'failed_at',
        'dropped_at',
    ];
}
