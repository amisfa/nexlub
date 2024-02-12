<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\UserInvoice;
use App\Models\UserPayment;
use Exception;
use Hidehalo\Nanoid\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;

class InvoiceController extends Controller
{
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('pages.deposit');
    }

    public function makeInvoice(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|Application
    {
        try {
            $nano = new Client();
            $token = $nano->generateId(21, Client::MODE_DYNAMIC);
            $invoice = UserInvoice::query()->create([
                'user_id' => auth()->id(),
                'invoice_token' => $token,
                'price_amount' => request()->price_amount ?? 100,
            ]);
            $data = [
                'source_amount' => $invoice->price_amount,
                'source_currency' => 'USD',
                'order_number' => $invoice->id,
                'order_name' => $invoice->user->username,
                'success_callback_url' => env('app_url') . 'dashboard/success-payment?token=' . $token . '&id=' . $invoice->id,
                'fail_callback_url' => env('app_url') . 'dashboard/failed-payment?id=' . $invoice->id,
                'email' => $invoice->user->email
            ];
            $response = Helper::createInvoice($data);
            $details = json_decode($response->body(), true);
            if ($response->status() !== 200) {
                $invoice->update(['failed_at' => now()]);
                return redirect('/')->with(['error' => array_values(json_decode($details['data']['message'], true))[0]]);
            }
            $invoice['plisio_id'] = $details['data']['txn_id'];
            $invoice['invoice_url'] = $details['data']['invoice_url'];
            $invoice->save();
            return Redirect::to($details['data']['invoice_url']);
        } catch (Exception $e) {
            return redirect('/')->with(['error' => 'Invoice created failed']);
        }
    }

    public function successPayment(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|Application
    {
        $token = request()->query('token');
        $invoiceId = request()->query('id');
        $invoice = UserInvoice::query()->where([['id', $invoiceId], ['invoice_token', $token]])->whereNull(['paid_at', 'dropped_at'])->first();
        if (!$invoice) {
            UserInvoice::query()->where('id', $invoiceId)->update(['dropped_at' => now()]);
            return redirect('/')->with(['error' => 'Invalid Payment Link']);
        }
        $invoice->paid_at = now();
        $invoice->save();
        Helper::addBalance([
            'user_id' => $invoice->user_id,
            'amount' => $invoice->price_amount,
            'log' => $invoice->price_amount . ' USD Paid by ' . $invoice->user->username
        ]);
        UserPayment::query()->create([
            'invoice_id' => $invoice->id,
            'user_id' => $invoice->user_id,
            'price_amount' => $invoice->price_amount,
            'status' => 'Paid'
        ]);
        return redirect('//payments')->with(['success' => 'Payment Paid Successfully']);
    }

    public function failedPayment(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|Application
    {
        $invoiceId = request()->query('id');
        $invoice = UserInvoice::query()->where('id', $invoiceId)->whereNull('failed_at')->first();
        if (!$invoice) return redirect('/')->with(['error' => 'Invalid Payment Link']);
        $invoice->failed_at = now();
        $invoice->save();
        UserPayment::query()->create([
            'invoice_id' => $invoice->id,
            'user_id' => $invoice->user_id,
            'price_amount' => $invoice->price_amount,
            'status' => 'Failed'
        ]);
        return redirect('/')->with(['error' => 'Payment Failed']);
    }
}
