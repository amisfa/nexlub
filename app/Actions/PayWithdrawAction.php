<?php

namespace App\Actions;

use App\Enums\CashOutStatuses;
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
        try {
            $withdraw = UserWithdraw::findOrFail($model->id);
            $response = Http::get('https://plisio.net/api/v1/operations/withdraw', [
                'api_key' => env('PILISIO_SECRET_KEY'),
                'currency' => $withdraw->currency,
                'amount' => $withdraw->amount,
                'type' => 'cash_out',
                'to' => $withdraw->user()->wallet_no,
            ]);
            if ($response->status() !== 200) $this->error('Pay Withdraw Failed');

            $response = json_decode($response->body(), true);
            $withdraw->tx_url = $response['tx_url'];
            $withdraw->status = CashOutStatuses::Paid;
            $withdraw->save();
            Helper::setPokerMavens([
                'Command' => 'LogsAddEvent',
                'Log' => 'Paid Withdraw Id' . $withdraw->id
            ]);
            $this->success('Pay Withdraw Successfully');
        } catch (Exception $e) {
            $this->error('Pay Withdraw Failed');
        }
    }

    public function renderIf($model, View $view): bool
    {
        return $model->status === CashOutStatuses::Waiting;
    }

}
