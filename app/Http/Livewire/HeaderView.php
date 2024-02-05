<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeaderView extends Component
{
    protected $listeners = ['reloadBalance' => 'reload'];

    public function reload(): void
    {
        $this->render();
    }

    public static function render()
    {
        $user = Auth::user();
        $updatedUser = $user->fresh();
        Auth::setUser($updatedUser);
        return view('livewire.header-view', ['user' => auth()->user()]);
    }
}
