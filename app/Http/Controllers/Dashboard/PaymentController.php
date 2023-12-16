<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function createPayment()
    {
//        try{
        $data = [
            'price_amount' => request()->price_amount ?? 100,
            'price_currency' => request()->price_currency ?? 'usd',
        ];
        $paymentDetails = Helper::createPayment($data);
        dd($paymentDetails);
//            return redirect('dashboard')->with(['success' => 'Payment created successfully', 'payment' => $paymentDetails]);
//        }catch(\Exception $e) {
//            return redirect('dashboard')->with(['error' => 'Payment created failed']);
//        }
    }
}
