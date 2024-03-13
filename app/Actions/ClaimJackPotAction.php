<?php

namespace App\Actions;

use App\Helpers\Helper;
use Exception;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class ClaimJackPotAction extends Action
{

    public $title = "Claim";

    public $icon = "pocket";

    public function handle($model, View $view): void
    {
        try {
            if (!$model->claimed_at) {
                Helper::addBalance([
                    'user_id' => auth()->id(),
                    'amount' => $model->amount,
                    'log' => $model->amount . ' USD Jack Pot Reward Claimed by ' . auth()->user()->username
                ]);
                $model->claimed_at = now();
                $model->save();
                $this->success('Claim Jack Pot Successfully');
            } else {
                $this->error('Claim Jack Pot Failed');
            }
        } catch (Exception $e) {
            $this->error('Claim Jack Pot Failed');
        }
    }

    public function renderIf($model, View $view): bool
    {
        return !$model->claimed_at;
    }
}
