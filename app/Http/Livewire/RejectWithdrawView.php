<?php

namespace App\Http\Livewire;

use App\Models\UserWithdraw;
use LivewireUI\Modal\ModalComponent;

class RejectWithdrawView extends ModalComponent
{
    public array $model;

    public function render()
    {
        //define your query
        $model = UserWithdraw::find($this->model['id']);
        return view('livewire.reject-withdraw-view', ['withdraw' => $model]);
    }
}
