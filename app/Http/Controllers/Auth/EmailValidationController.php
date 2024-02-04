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
            if (Auth::user()) return redirect('dashboard')->with(['error' => 'Invalid Email Validation']);
            return redirect('auth/login')->withErrors(['email-verify' => 'Invalid Email Validation']);
        }
        $user = User::find($userId);
        if ($user->email_verified_at) {
            return redirect('/')->with(['success' => 'Your Email Already Verified!']);
        }
        $user->email_verified_at = now();
        $user->save();
        $userVerify->update(['deleted_at' => now()]);
        if (!Auth::user()) Auth::loginUsingId($user->id);
        return redirect('/')->with(['success' => 'Your Email Verified!']);
    }
}
