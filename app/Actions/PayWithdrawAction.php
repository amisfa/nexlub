<?php

namespace App\Actions;

use App\Enums\WithdrawStatuses;
use App\Helpers\Helper;
use App\Models\UserWithdraw;
use Exception;
use Illuminate\Support\Facades\Http;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class PayWithdrawAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Pay";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "check-circle";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
//        try {
            $withdraw = UserWithdraw::findOrFail($model->id);
            $payAmount = 0;
            array_map(function ($currency) use (&$payAmount, $withdraw) {
                if ($currency['currency'] == $withdraw->currency) $payAmount = $currency['rate_usd'] * $withdraw->amount;
            }, Helper::getAvailableCurrencies());
            $response = Http::get('https://plisio.net/api/v1/operations/withdraw', [
                'api_key' => env('PILISIO_SECRET_KEY'),
                'currency' => $withdraw->currency,
                'amount' => $payAmount,
                'type' => 'cash_out',
                'to' => $withdraw->user->wallet_no,
                'feePlan' => 'normal'
            ]);
            if ($response->status() !== 201) $this->error('Withdraw Failed');
            $response = json_decode($response->body(), true);
            $withdraw->tx_url = $response['tx_url'];
            $withdraw->status = WithdrawStatuses::Paid;
            $withdraw->save();
            Helper::setPokerMavens([
                'Command' => 'LogsAddEvent',
                'Log' => 'Paid Withdraw Id' . $withdraw->id
            ]);
            dd($withdraw);
            $this->success('Withdraw Successfully');
//        } catch (Exception $e) {
//            $this->error('Withdraw Failed');
//        }
    }

    public function renderIf($model, View $view): bool
    {
        return $model->status === WithdrawStatuses::Waiting;
    }

}
