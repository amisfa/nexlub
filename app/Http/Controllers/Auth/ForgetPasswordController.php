<?php

namespace App\Http\Controllers\Auth;

use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function store(Request $request)
    {
        $messages = [
            'email.exists' => 'No User With This Email Exists!',
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:auth_user,email',
        ], $messages);
        if ($validator->fails()) {
            return redirect('auth/forget-password')->withErrors($validator->messages())->withInput();
        }
        $user = User::where('email', $request->email)->first();
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);
        Mail::to($request->email)->send(new ForgotPassword($token, $user));
        return redirect('auth/forget-password')->withErrors(['email-sent' => 'We have e-mailed your password reset link!']);
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        if (Auth::user()) return redirect('dashboard');
        return view('auth.forget-password');
    }
}
