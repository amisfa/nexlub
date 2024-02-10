<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class UserWithdrawController extends Controller
{
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $currencies = Helper::getAvailableCurrencies();
        return view('pages.withdraw', ['currencies' => $currencies]);
    }

    public function makeWithdraw(): \Illuminate\Http\RedirectResponse
    {
        try {
            if (auth()->user()->balance < request('amount')) return back()->with(['error' => 'Insufficient Balance']);
            Helper::decBalance([
                'user_id' => auth()->id(),
                'amount' => request('amount'),
                'log' => request('amount') . ' ' . request('currency') . ' Withdraw by ' . auth()->user()->username
            ]);
            auth()->user()->withdraws()->create([
                'amount' => request('amount'),
                'currency' => request('currency')
            ]);
            return back()->with(['success' => 'Withdraw Submitted']);
        } catch (Exception $e) {
            return back()->with(['error' => 'Add Withdraw Request Failed']);
        }
    }
}
