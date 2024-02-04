<?php

namespace App\Http\Controllers\User;

use Illuminate\Routing\Controller;


class EditProfileController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('profile.edit');
    }
}
