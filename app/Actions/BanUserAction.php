<?php

namespace App\Actions;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class BanUserAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Ban";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "user-x";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        Helper::setPokerMavens([
            "Command" => "BlacklistAdd",
            'Player' => $model->username,
        ]);
        $response = Helper::setPokerMavens([
            "Command" => "BlacklistList",
            "Fields" => "ID,Player",
        ]);
        foreach ($response['Player'] as $key => $player) {
            if ($player == $model->username) {
                $model->banned_id = $response['ID'][$key];
                $model->save();
            }
        }
    }

    public function renderIf($model, View $view): bool
    {
        return $model->banned_id === null;
    }

}
