<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
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

        return redirect('auth/login')->withErrors($validator->messages());
    }

//    Auth::login($user);
        Auth::loginUsingId($user->id);


        return redirect(RouteServiceProvider::HOME);
}


}
