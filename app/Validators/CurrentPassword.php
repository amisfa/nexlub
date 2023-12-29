<?php

namespace App\Validators;

use Illuminate\Support\Facades\Hash;

class CurrentPassword
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        return Hash::check($value, auth()->user()->password);
    }
}
