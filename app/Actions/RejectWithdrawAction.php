<?php

namespace App\Actions;

use App\Enums\CashOutStatuses;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class RejectWithdrawAction extends Action
{
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
    public string $modalView = "reject-withdraw-view";


    public function renderIf($model, View $view): bool
    {
        return $model->status === CashOutStatuses::Waiting;
    }

}
