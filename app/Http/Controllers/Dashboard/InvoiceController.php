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
        return view('pages.invoice');
    }

    public function makeInvoice(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|Application
    {
        try {
            $token = Str::random(18);
            $invoiceId = Str::ulid(now())->toBase32();
            $data = [
                'source_amount' => request()->price_amount ?? 100,
                'source_currency' => 'USD',
                'order_number' => $invoiceId,
                'order_name' => auth()->user()->username,
                'success_callback_url' => env('app_url') . 'dashboard/success-payment?token=' . $token . '&id=' . $invoiceId,
                'fail_callback_url' => env('app_url') . 'dashboard/failed-payment?id=' . $invoiceId,
                'email' => auth()->user()->email
            ];
            $response = Helper::createInvoice($data);
            $details = json_decode($response->body(), true);
            if ($response->status() !== 200) return redirect('dashboard')->with(['error' => array_values(json_decode($details['data']['message'], true))[0]]);
            $item = UserInvoice::query()->create([
                'user_id' => auth()->id(),
                'invoice_token' => $token,
                'invoice_id' => $invoiceId,
                'plisio_id' => $details['data']['txn_id'],
                'invoice_url' => $details['data']['invoice_url'],
                'price_amount' => request()->price_amount ?? 100,
            ]);
            return Redirect::to($details['data']['invoice_url']);
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
            'status' => 'Paid'
        ]);
        Helper::addBalance([
            'user_id' => $invoice->user_id,
            'amount' => $invoice->price_amount,
            'log' => $invoice->price_amount . ' USD Paid by ' . auth()->user()->username
        ]);
        return redirect('dashboard/payments')->with(['success' => 'Payment Paid Successfully']);
    }

    public function failedPayment(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|Application
    {
        $invoiceId = request()->query('id');
        $invoice = UserInvoice::query()->where('invoice_id', $invoiceId)->whereNull('failed_at')->first();
        if (!$invoice) return redirect('dashboard')->with(['error' => 'Invalid Payment Link']);
        $invoice->failed_at = now();
        $invoice->save();
        UserPayment::query()->create([
            'invoice_id' => $invoice->invoice_id,
            'user_id' => $invoice->user_id,
            'price_amount' => $invoice->price_amount,
            'status' => 'Failed'
        ]);
        return redirect('dashboard')->with(['error' => 'Payment Failed']);
    }
}
