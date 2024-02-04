<?php

namespace App\Http\Controllers\Statics;

use App\Enums\WithdrawStatuses;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\UserWithdraw;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class WithdrawManagementController extends Controller
{
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $availableCurrencies = Helper::getAvailableCurrencies();
        return view('pages.withdraw-management', ['currencies' => $availableCurrencies]);
    }

    public function rejectWithdraw(UserWithdraw $withdraw)
    {
        try {
            Helper::addBalance([
                'user_id' => $withdraw->user->id,
                'amount' => $withdraw->amount,
                'log' => $withdraw->amount . ' USD Rejected Withdraw by ' . auth()->user()->username . ' ' . request('rejected_reason')
            ]);
            $withdraw->status = WithdrawStatuses::Rejected;
            $withdraw->rejected_comment = request('rejected_comment');
            $withdraw->save();
            return back()->with(['success' => 'Withdraw Rejected Successfully']);
        } catch (Exception $e) {
            return back()->with(['error' => 'Withdraw Rejected Failed']);
        }
    }
}
