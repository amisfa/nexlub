<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use illuminate\Htpp\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);
    }
}
