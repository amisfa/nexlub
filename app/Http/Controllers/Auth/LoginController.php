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
    public function create()
    {
        return view('auth.login');
    }


    public function store(Request $request)
{
    $messages = [
        'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
        'g-recaptcha-response.required' => 'Please complete the captcha'
    ];
    $validator = Validator::make($request->all(), [
        'username' => 'required|unique:auth_user',
        'password' => 'required|min:8',
        'g-recaptcha-response' => 'required|recaptcha'
    ], $messages);

    if ($validator->fails()) {
        return redirect('auth/login')->withErrors($validator->messages());
    }

    $user = User::where('username', $request->input('username'))->first();
    if (!$user || !Hash::check($request->input('password'), $user->password)) {
        return response()->json([
            'message' => 'The provided credentials are incorrect.',
        ], 401);
    }

    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
}


}
