<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeaderView extends Component
{
    protected $listeners = ['reloadBalance' => 'reload'];

    public function reload(): void
    {
        $user = Auth::user();
        $updatedUser = $user->fresh();
        Auth::setUser($updatedUser);
        $this->render();
    }

    public static function render()
    {
        return view('livewire.header-view', ['user' => auth()->user()]);
    }
}
