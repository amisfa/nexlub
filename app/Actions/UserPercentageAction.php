<?php

namespace App\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class UserPercentageAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "User Rake Percentage";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "repeat";

    public string $modalView = "user-rake-percentage-view";

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
