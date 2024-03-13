<?php

namespace App\Actions;

use App\Enums\WithdrawStatuses;
use App\Helpers\Helper;
use Exception;
use LaravelViews\Actions\Action;
use LaravelViews\Actions\Confirmable;
use LaravelViews\Views\View;

class CancelWithdrawAction extends Action
{
    use Confirmable;

    public function getConfirmationMessage($item = null): string
    {
        return 'Are You Sure?';
    }

    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Cancel";

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
    public function handle($model, View $view): void
    {
        try {
            if($model->status !== WithdrawStatuses::Canceled){
                Helper::addBalance([
                    'user_id' => auth()->id(),
                    'amount' => $model->amount,
                    'log' => request('amount') . ' USD Canceled Withdraw by ' . auth()->user()->username
                ]);
                $model->status = WithdrawStatuses::Canceled;
                $model->save();
                $this->success('Withdraw Canceled Successfully');
            }else{
                $this->error('Withdraw Already Canceled');
            }
        } catch (Exception $e) {
            $this->error('Withdraw Cancel Failed');
        }
    }

    public function renderIf($model, View $view): bool
    {
        return $model->status === WithdrawStatuses::Waiting;
    }
}
