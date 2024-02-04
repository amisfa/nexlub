<?php

namespace App\Http\Controllers\User;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;


class UserManagementController extends Controller
{
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('pages.user-management');
    }
}
