<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{

    protected $table = 'user_payment';

    protected $fillable = [
        'email',
    ];

}
