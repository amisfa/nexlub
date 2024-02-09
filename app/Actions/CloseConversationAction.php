<?php

namespace App\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class CloseConversationAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Close";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "x";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        $model->closed_at = now();
        $model->save();

    }

    public function renderIf($model, View $view): bool
    {
        return !$model->closed_at;
    }

}
