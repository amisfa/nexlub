<?php

namespace App\Http\Livewire;

use App\Helpers\Helper;
use Livewire\Component;

class RakeBackView extends Component
{
    public function create()
    {
        return view('pages.rake-back');
    }

    public function render()
    {
        return view('livewire.user-rake-back', ['user' => auth()->user()]);
    }

    public function claim()
    {
        $remainRakeBack = auth()->user()->remain_rake_back;
        $claimedRakeBack = auth()->user()->claimed_rake_back;
        auth()->user()->userRake()->update([
            'claimed_rake_back' => $remainRakeBack + $claimedRakeBack
        ]);
        Helper::addBalance([
            'user_id' => auth()->id(),
            'amount' => $remainRakeBack,
            'log' => $remainRakeBack . ' USD Claimed Rake Back by ' . auth()->user()->username
        ]);
        $this->emit('reloadBalance');
        $this->render();
    }
}
