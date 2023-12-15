<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class PlayController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.Play');
    }
}
