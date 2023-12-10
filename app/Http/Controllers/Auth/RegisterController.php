<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (request()->has('ref')) {
            session(['referrer' => request()->query('ref')]);
        }

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
            'avatar' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
//            'g-recaptcha-response' => 'required|recaptcha'
        ], $messages);
        if ($validator->fails()) {
            return redirect('auth/register')->withErrors($validator->messages())->withInput();
        }
        $referrer = User::query()->where('referral_token', session()->pull('referrer'))->first();
        $user = User::query()->create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referrer_id' => $referrer ? $referrer->id : null,
            'referral_token' => Str::random(16),
            'wallet_no' => $request->wallet_no,
        ]);
        $response = Helper::setPokerMavens([
            "Command" => "AccountsAdd",
            'Player' => $request->username,
            'Email' => $request->email,
            'PW' => Hash::make($request->password),
            'Custom1' => $request->wallet_no,
        ]);
        Auth::loginUsingId($user->id);
        return redirect(RouteServiceProvider::HOME);
    }
}
