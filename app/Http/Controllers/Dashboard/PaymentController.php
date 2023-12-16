<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
class PaymentController extends Controller
{
    public function createCryptoPayment()
    {
//        try{
            $data = [
                'price_amount' => request()->price_amount ?? 100,
                'price_currency' => request()->price_currency ?? 'usd',
                'order_id' => uniqid(), // you can generate your order id as you wish
                'pay_currency' => request()->pay_currency ?? 'btc',
                'payout_currency' => request()->payout_currency ?? 'btc',
            ];
            $paymentDetails = Nowpayments::createPayment($data);
            dd($paymentDetails);
//            return redirect('dashboard')->with(['success' => 'Payment created successfully', 'payment' => $paymentDetails]);
//        }catch(\Exception $e) {
//            return redirect('dashboard')->with(['error' => 'Payment created failed']);
//        }
    }
}
