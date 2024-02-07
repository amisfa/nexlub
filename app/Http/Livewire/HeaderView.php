<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HeaderView extends Component
{
    public function render()
    {
        return view('livewire.header-view', ['user' => auth()->user()]);
    }
}
