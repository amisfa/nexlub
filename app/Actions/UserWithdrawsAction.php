<?php

namespace App\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class UserWithdrawsAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Withdraws";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "download";

    public string $modalView = "user-modal-withdraws-view";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        // Your code here
    }
}
