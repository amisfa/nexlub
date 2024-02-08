<?php

namespace App\Actions;

use LaravelViews\Actions\Action;

class ContinueConversationAction extends Action
{
    public $title = "Continue the conversation";

    public string $modalView = "ticket-upsert";

    public $icon = "message-square";

}
