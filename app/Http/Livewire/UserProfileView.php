<?php

namespace App\Http\Livewire;

use App\Actions\UserEditAction;
use App\Models\User;
use LaravelViews\Views\DetailView;

class UserProfileView extends DetailView
{
    protected $modelClass = User::class;

    public function detail($model)
    {
        return [
            '<p class="title"> Name </p>' => $model->username,
            '<p class="title">Email</p>' => '<p class="' . $this->isEmailVerified($model->email_verified_at) . '">' . $model->email . ' (' . $this->getVerifiedText($model->email_verified_at) . ')' . '</p>',
            '<p class="title"> Wallet.No </p>' => $model->wallet_no,
        ];
    }

    public function heading($model)
    {
        return [
            "Edit Profile",
            "{$model->username}",
        ];
    }

    public function actions(): array
    {
        return [new UserEditAction()];
    }

    public static function isEmailVerified($verified_at): string
    {
        return $verified_at ? 'text-success' : 'text-danger';
    }

    public static function getVerifiedText($verified_at): string
    {
        return $verified_at ? "Verified" : "Not Verified";
    }
}
