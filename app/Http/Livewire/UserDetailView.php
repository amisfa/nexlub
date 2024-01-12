<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class UserDetailView extends ModalComponent
{
    public function render()
    {
        return view('livewire.user-detail');
    }
}
