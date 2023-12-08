<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $messages = [
            'password_confirmation.same' => 'Password Confirmation should match the Password',
            'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
            'g-recaptcha-response.required' => 'Please complete the captcha'
        ];
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:auth_user',
            'email' => 'required|email|unique:auth_user',
            'wallet_no' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
            'g-recaptcha-response' => 'required|recaptcha'
        ], $messages);
        if ($validator->fails()) {
            return redirect('auth/register')->withErrors($validator->messages())->withInput();
        }
        $user = User::query()->create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'wallet_no' => $request->wallet_no,
        ]);
        Helper::PokerMavens([
            "Command" => "AccountsAdd",
            'Player' => $request->username,
            'Email' => $request->email,
            'PW' => Hash::make($request->password)
        ]);
        Auth::loginUsingId($user->id);
        return redirect(RouteServiceProvider::HOME);
    }
}
