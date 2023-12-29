<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $token = $request->token;
        $email = $request->email;
        $messages = [
            'password_confirmation.same' => 'Password Confirmation should match the Password',
        ];
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
        ], $messages);
        if ($validator->fails())
            return redirect("auth/reset-password?email=$email&token=$token")->withErrors($validator->messages())->withInput();
        $user = User::where('email', $request->email)->first();
        $passwordReset = DB::table('password_resets')
            ->where([
                'email' => $email,
                'token' => $token,
                'deleted_at' => null
            ])
            ->first();
        if (!$passwordReset)
            return redirect("auth/reset-password?email=$email&token=$token")->withErrors(['password' => ['Invalid reset link']]);
        Helper::setPokerMavens([
            "Command" => "AccountsEdit",
            'Player' => $user->username,
            'PW' => $request->password,
        ]);
        $user->password = Hash::make($request->password);
        $user->save();
        DB::table('password_resets')->where(['email' => $email])->update(['deleted_at' => now()]);
        return redirect('auth/login');
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        if (Auth::user()) return redirect('dashboard');
        return view('auth.resetPassword');
    }
}
