<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeaderView extends Component
{

    public function render()
    {
        $user = Auth::user();
        $updatedUser = $user->fresh();
        Auth::setUser($updatedUser);
        return view('livewire.header-view', ['user' => auth()->user()]);
    }
}
