<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\UserPayment;

class PaymentController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.payments');
    }

    public function createPayment()
    {
        try {
            $data = [
                'price_amount' => request()->price_amount ?? 100,
                'price_currency' => 'usd',
                'pay_currency' => request()->pay_currency ?? 'btc',
                'is_fee_paid_by_user' => true,
                'is_fixed_rate' => true
            ];
            $response = Helper::createPayment($data);
            $details = json_decode($response->body(), true);
            $payment = UserPayment::query()->create([
                'user_id' => auth()->id(),
                'payment_id' => $details['payment_id'],
                'pay_address' => $details['pay_address'],
                'price_amount' => $details['price_amount'],
                'price_currency' => $details['price_currency'],
                'pay_amount' => $details['pay_amount'],
                'pay_currency' => $details['pay_currency'],
                'status' => $details['payment_status'],
            ]);
            return redirect('dashboard')->with(['success' => 'Payment created successfully', 'payment' => $payment]);
        } catch (\Exception $e) {
            return redirect('dashboard')->with(['error' => 'Payment created failed']);
        }
    }

    public function getEstimatedPrice()
    {
        $currency = request()->currency;
        $amount = request()->amount;
        $response = Helper::getEstimatedPrice([
            'currency_from' => 'usd',
            'amount' => $amount,
            'currency_to' => $currency
        ]);
        $details = json_decode($response, true);
        return response()->json($details, 200);
    }
}
