<?php

namespace App\Http\Livewire;

use App\Models\User;
use LaravelViews\Actions\RedirectAction;
use LaravelViews\Views\DetailView;

class UserProfileView extends DetailView
{
    protected $modelClass = User::class;

    public function detail($model)
    {
        return [
            '<p class="title"> Name </p>' => old('username', $model->username),
            '<p class="title"> Email </p>' => old('email', $model->email),
            '<p class="title"> Wallet.No </p>' => old('wallet_no', $model->wallet_no),
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
        return [
            new RedirectAction('profile-edit', 'Edit user', 'edit'),
        ];
    }
}
