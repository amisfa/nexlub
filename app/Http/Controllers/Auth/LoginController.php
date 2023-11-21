<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required|confirmed|min:8',
    ]);

    $user = User::where('username', $request->input('username'))->first();
    if (!$user || !Hash::check($request->input('password'), $user->password)) {
        return response()->json([
            'message' => 'The provided credentials are incorrect.',
        ], 401);
    }

    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
}

    public function create()
    {
        return view('auth.login');
    }
}
