<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
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
        $user = User::find(auth()->id());
        $user->update($request->all());
        if ($user->wasChanged('email')) {
            $user->email_verified_at = null;
            $user->save();
            Helper::sendValidationEmail($user);
        }
        if ($user->wasChanged()) {
            Helper::setPokerMavens([
                "Command" => "AccountsEdit",
                'Player' => $user->username,
                'Email' => $user->email,
                'Avatar' => $request->avatar,
                'Custom1' => $request->wallet_no,
            ]);
            return redirect('/profile')->withStatus(__('Profile successfully updated.'));
        } else return back();
    }

    public function changeUserPassword()
    {
        $messages = [
            'password_confirmation.same' => 'Password Confirmation should match the Password',
        ];
        $validator = Validator::make(request()->all(), [
            'old_password' => 'required|min:8|current_password',
            'password' => 'required|min:8|different:old_password',
            'password_confirmation' => 'required|min:8|same:password',
        ], $messages);
        if ($validator->fails()) return back()->withErrors($validator->messages());
        $user = User::find(auth()->id());
        Helper::setPokerMavens([
            "Command" => "AccountsEdit",
            'Player' => $user->username,
            'PW' => request('password'),
        ]);
        $user->update(['password' => Hash::make(request('password'))]);
        if ($user->wasChanged()) return back()->withPasswordStatus(__('Password successfully updated.'));
        else return back();
    }

    public function resendEmail(User $user): void
    {
        Helper::sendValidationEmail($user);
    }
}
