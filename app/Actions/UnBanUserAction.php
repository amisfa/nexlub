<?php

namespace App\Actions;

use App\Helpers\Helper;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class UnBanUserAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Unban";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "user-check";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        Helper::setPokerMavens([
            "Command" => "BlacklistDelete",
            "ID" => $model->banned_id,
        ]);
        $model->banned_id = null;
        $model->save();
    }

    public function renderIf($model, View $view): bool
    {
        return $model->banned_id !== null;
    }
}
