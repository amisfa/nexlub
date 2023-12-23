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
            $invoiceId = Str::uuid();
            $data = [
                'price_amount' => request()->price_amount ?? 100,
                'order_id' => $invoiceId,
                'price_currency' => 'usd',
                'pay_currency' => request()->pay_currency ?? 'btc',
                'success_url' => env('url_front') . 'dashboard/success-payment?token=' . $token . '&id=' . $invoiceId,
                'cancel_url' => env('url_front') . 'dashboard/cancel-payment?id=' . $invoiceId,
                'partially_paid_url' => env('url_front') . 'dashboard/partially-payment?id=' . $invoiceId,
                'is_fee_paid_by_user' => "true",
                'is_fixed_rate' => "true",
            ];
            $response = Helper::createInvoice($data);
            $details = json_decode($response->body(), true);
            UserInvoice::query()->create([
                'user_id' => auth()->id(),
                'invoice_token' => $token,
                'invoice_id' => $invoiceId,
                'now_payment_id' => $details['id'],
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

    public function successPayment(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|Application
    {
        $token = request()->query('token');
        $invoiceId = request()->query('id');
        $invoice = UserInvoice::query()->where([['invoice_id', $invoiceId], ['invoice_token', $token]])->whereNull(['paid_at', 'dropped_at'])->first();
        if (!$invoice) {
            UserInvoice::query()->where('invoice_id', $invoiceId)->update(['dropped_at' => now()]);
            return redirect('dashboard')->with(['error' => 'Invalid Payment Link']);
        }
        $invoice->paid_at = now();
        $invoice->save();
        UserPayment::query()->create([
            'invoice_id' => $invoice->invoice_id,
            'user_id' => $invoice->user_id,
            'price_amount' => $invoice->price_amount,
            'price_currency' => $invoice->price_currency,
            'pay_currency' => $invoice->pay_currency,
            'status' => 'Paid'
        ]);
        Helper::addBalance([
            'user_id' => $invoice->user_id,
            'amount' => $invoice->price_amount,
        ]);
        return redirect('dashboard/payments')->with(['success' => 'Payment Paid Successfully']);
    }

    public function cancelPayment(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|Application
    {
        $invoiceId = request()->query('id');
        $invoice = UserInvoice::query()->where('invoice_id', $invoiceId)->whereNull('canceled_at')->first();
        if (!$invoice) return redirect('dashboard')->with(['error' => 'Invalid Payment Link']);
        $invoice->canceled_at = now();
        $invoice->save();
        UserPayment::query()->create([
            'invoice_id' => $invoice->invoice_id,
            'user_id' => $invoice->user_id,
            'price_amount' => $invoice->price_amount,
            'price_currency' => $invoice->price_currency,
            'pay_currency' => $invoice->pay_currency,
            'status' => 'Canceled'
        ]);
        return redirect('dashboard')->with(['success' => 'Payment Canceled Successfully']);
    }

    public function partiallyPaidPayment(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|Application
    {
        $invoiceId = request()->query('id');
        $invoice = UserInvoice::query()->where('invoice_id', $invoiceId)->whereNull('partially_paid_at')->first();
        if (!$invoice) return redirect('dashboard')->with(['error' => 'Invalid Payment Link']);
        $invoice->partially_paid_at = now();
        $invoice->save();
        UserPayment::query()->create([
            'invoice_id' => $invoice->invoice_id,
            'user_id' => $invoice->user_id,
            'price_amount' => $invoice->price_amount,
            'price_currency' => $invoice->price_currency,
            'pay_currency' => $invoice->pay_currency,
            'status' => 'Partially Paid'
        ]);
        return redirect('dashboard')->with(['error' => 'Payment Partially Paid Successfully']);
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
