<?php

namespace App\Http\Livewire;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class UserModalWithdrawsView extends ModalComponent
{
    public array $model;

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $model = User::find($this->model['id']);
        return view('livewire.user-withdraws', ['user' => $model]);
    }
}
