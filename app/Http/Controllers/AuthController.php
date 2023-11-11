<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function loginView()
    {
        if (auth()->id()) return redirect()->route('panel.dashboard');
        return view('login');
    }

    public function login()
    {
        return response()->json('valid', 201);
    }
//
//    public function register()
//    {
//        if (auth()->id())
//            return redirect()->route('panel.dashboard');
//        return view('login');
//    }
//    public function logout()
//    {
//        auth()->logout();
//        return redirect()->route('home');
//    }

}
