<?php

namespace App\Actions;

use App\Helpers\Helper;
use Exception;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class ClaimBadBeatRewardAction extends Action
{

    public $title = "Claim";

    public $icon = "pocket";

    public function handle($model, View $view): void
    {
        try {
            Helper::addBalance([
                'user_id' => auth()->id(),
                'amount' => $model->amount,
                'log' => $model->amount . ' USD Bad Beat Reward Claimed by ' . auth()->user()->username
            ]);
            $model->claimed_at = now();
            $model->save();
            $this->success('Claim Bad Beat Successfully');} catch (Exception $e) {
            $this->error('Claim Bad Beat Failed');
        }
    }

    public function renderIf($model, View $view): bool
    {
        return !$model->claimed_at;
    }
}
