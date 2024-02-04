<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DepositController extends Controller
{
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('pages.deposit');
    }
}
