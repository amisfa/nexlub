<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class EmailValidationController extends Controller
{
    public function emailVerify(User $user)
    {
        $token = request()->query('token');
        $userId = request()->query('user_id');
        $userVerify = UserVerify::query()->where('token', $token)->where('user_id', $userId)->first();
        if (!$userVerify) {
            if (Auth::user()) return redirect('/')->with(['error' => 'Email verification link expired.']);
            return redirect('auth/login')->withErrors(['email-verify' => 'Email verification link expired.']);
        }
        $user = User::find($userId);
        $userVerify->delete();
        if ($user->email_verified_at) {
            return redirect('auth/login')->withErrors(['email-verify' => 'Your Email Already Verified!']);
        }
        $user->email_verified_at = now();
        $user->save();
        return redirect('/')->with(['success' => 'Your Email Verified!']);
    }
}
