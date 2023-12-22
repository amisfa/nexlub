<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;

class CreatePaymentController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $availableCurrencies = Helper::getAvailableCurrencies();
        return view('pages.createPayment', ['currencies' => $availableCurrencies]);
    }
}
