<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;


class DashboardController extends Controller
{
    public function create()
    {
        return view('dashboard');
    }
}
