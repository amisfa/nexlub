<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $messages = [
            'password_confirmation.same' => 'Password Confirmation should match the Password',
        ];
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
        ], $messages);
        if ($validator->fails()) {
            return redirect('auth/reset-password')->withErrors($validator->messages())->withInput();
        }
        $user = User::where('email', $request->email)->first();
        $passwordReset = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
                'deleted_at' => null
            ])
            ->first();

        if (!$passwordReset) {
            return redirect('auth/reset-password')->withErrors('test');
        }
        $user->password = Hash::make($request->password);
        $user->save();
        DB::table('password_resets')->where(['email' => $request->email])
            ->update(['deleted_at' => now()]);
        return redirect('auth/login');
    }
    public function create()
    {
        return view('auth.resetPassword');
    }
}
