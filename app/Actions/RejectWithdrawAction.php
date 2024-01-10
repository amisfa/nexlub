<?php

namespace App\Actions;

use App\Enums\CashOutStatuses;
use App\Helpers\Helper;
use LaravelViews\Actions\Action;
use LaravelViews\Actions\Confirmable;
use LaravelViews\Views\View;

class RejectWithdrawAction extends Action
{
    use Confirmable;

    public function getConfirmationMessage($item = null)
    {
        return 'Are You Sure About Reject This Item?';
    }

    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Reject";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "corner-down-left";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        try {
            Helper::addBalance([
                'user_id' => auth()->id(),
                'amount' => $model->amount,
                'log' => request('amount') . ' USD Rejected Withdraw by ' . auth()->user()->username
            ]);
            $model->status = CashOutStatuses::Rejected;
            $model->save();
            $this->success('Withdraw Rejected Successfully');
        } catch (Exception $e) {
            $this->error('Withdraw Reject Faild');
        }
    }

    public function renderIf($model, View $view)
    {
        return $model->status === CashOutStatuses::Waiting;
    }
}
