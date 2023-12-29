<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Views\DetailView;

class ExampleDetailView extends DetailView
{
    public function detail($model)
    {
        $model = auth()->user();
        return [
            '<p class="title"> Name </p>' => old('username', $model->username),
            '<p class="title"> Email </p>' => old('email', $model ->email),
            '<p class="title"> Wallet.No </p>' => old('wallet_no', $model->wallet_no),
        ];
    }

    public function heading()
    {
        $model = auth()->user();
        return [
            "{$model->username}",
            "user profile data",
        ];
    }
}
