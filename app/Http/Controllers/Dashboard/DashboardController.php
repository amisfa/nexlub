<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;


class DashboardController extends Controller
{
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $logs = Helper::getHistoryLog();
        dd($logs);
        return view('dashboard');
    }
}
