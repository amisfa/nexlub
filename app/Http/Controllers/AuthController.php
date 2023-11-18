<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Resources\Resource;
use App\Models\Desk\Meeting\Meeting;
use App\Models\User;
use App\Notifications\System\NotificationTemplate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView()
    {
        if (auth()->id()) return redirect()->route('panel.dashboard');
        return view('login');
    }

    public function login(Request $request): JsonResponse
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('username', $request->input('username'))->first();
        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
            ], 401);
        }
        $plainTextToken = $user->createToken($request->input('username'))->plainTextToken;
        return response()->json(['jwt' => $plainTextToken], 200);
    }


    public function registerView()
    {
        if (auth()->id())
            return redirect()->route('panel.dashboard');
        return view('register');
    }

    public function forgetPasswordView()
    {
        if (auth()->id())
            return redirect()->route('panel.dashboard');
        return view('forgetPassword');
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return redirect()->route('home');
    }

}
