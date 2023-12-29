<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\ProfileRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('profile.view');
    }

    public function update(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('profile.edit');
    }

    public function editUserDetails(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function changeUserPassword()
    {
        $messages = [
            'password_confirmation.same' => 'Password Confirmation should match the Password',
        ];
        $validator = Validator::make(request()->all(), [
            'avatar' => 'required',
            'old_password' => 'required|min:8|current_password',
            'password' => 'required|min:8|different:old_password',
            'password_confirmation' => 'required|min:8|same:password',
        ], $messages);
        if ($validator->fails()) return back()->withErrors($validator->messages());
        auth()->user()->update(['password' => Hash::make(request('password'))]);
        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
