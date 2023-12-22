<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\UserInvoice;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class InvoiceController extends Controller
{
    public function createInvoice(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $availableCurrencies = Helper::getAvailableCurrencies();
        return view('pages.createInvoice', ['currencies' => $availableCurrencies]);
    }

    public function indexView(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('pages.invoices');
    }

    public function makeInvoice(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|Application
    {
        try {
            $data = [
                'price_amount' => request()->price_amount ?? 100,
                'price_currency' => 'usd',
                'pay_currency' => request()->pay_currency ?? 'btc',
            ];
            $response = Helper::createInvoice($data);
            $details = json_decode($response->body(), true);
            $invoice = UserInvoice::query()->create([
                'user_id' => auth()->id(),
                'invoice_id' => $details['id'],
                'invoice_url' => $details['invoice_url'],
                'price_amount' => $details['price_amount'],
                'price_currency' => $details['price_currency'],
                'pay_currency' => $details['pay_currency'],
            ]);
            return redirect('dashboard')->with(['success' => 'Invoice created successfully', 'invoice' => $invoice]);
        } catch (Exception $e) {
            return redirect('dashboard')->with(['error' => 'Invoice created failed']);
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
