<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = User::where('work_email', $request->email)->first();
        if (!$user) abort(404);

        $passwordReset = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
                'deleted_at' => null
            ])
            ->first();

        if (!$passwordReset) abort(401);

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where(['email' => $request->email])
            ->update(['deleted_at' => now()]);
        return response()->json(true);
    }
    public function create()
    {
        return view('auth.resetPassword');
    }
}
