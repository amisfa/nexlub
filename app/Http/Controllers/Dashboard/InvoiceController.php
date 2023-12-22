<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\UserInvoice;
use App\Models\UserPayment;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $availableCurrencies = Helper::getAvailableCurrencies();
        return view('pages.invoice', ['currencies' => $availableCurrencies]);
    }

    public function makeInvoice(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|Application
    {
        try {
            $token = Str::random(18);
            $data = [
                'price_amount' => request()->price_amount ?? 100,
                'price_currency' => 'usd',
                'pay_currency' => request()->pay_currency ?? 'btc',
                'success_url' => env('url_front') . 'dashboard/success-payment/?token=' . $token,
                'cancel_url' => env('url_front') . 'dashboard/cancel-payment',
                'partially_paid_url' => env('url_front') . 'dashboard/partially-payment',
                'is_fee_paid_by_user' => "true",
                'is_fixed_rate' => "true",
            ];
            $response = Helper::createInvoice($data);
            $details = json_decode($response->body(), true);
            UserInvoice::query()->create([
                'user_id' => auth()->id(),
                'invoice_token' => $token,
                'invoice_id' => $details['id'],
                'invoice_url' => $details['invoice_url'],
                'price_amount' => $details['price_amount'],
                'price_currency' => $details['price_currency'],
                'pay_currency' => $details['pay_currency'],
            ]);
            return Redirect::to($details['invoice_url']);
        } catch (Exception $e) {
            return redirect('dashboard')->with(['error' => 'Invoice created failed']);
        }
    }

    public function successPayment()
    {
        $token = request()->query('token');
        $invoice = UserInvoice::query()->where('invoice_token', $token)->whereNull('paid_at')->first();
        if (!$invoice) return redirect('dashboard')->with(['error' => 'Invalid Payment Link']);
        $invoice->paid_at = now();
        $invoice->save();
        UserPayment::query()->create([
            'user_id' => $invoice->user_id,
            'price_amount' => $invoice->price_amount,
            'price_currency' => $invoice->price_currency,
            'pay_currency' => $invoice->pay_currency,
        ]);
        Helper::addBalance([
            'user_id' => $invoice->user_id,
            'amount' => $invoice->price_amount,
        ]);
        return redirect('dashboard/payments')->with(['success' => 'Payment Paid Successfully']);
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
