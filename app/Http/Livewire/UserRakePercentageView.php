<?php

namespace App\Http\Livewire;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class UserRakePercentageView extends ModalComponent
{
    public array $model;
    public int $rakeBack;
    public int $affiliateRake;

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $model = User::find($this->model['id']);
        return view('livewire.user-rake-percentage', ['user' => $model]);
    }

    public function change()
    {
        $this->emit('closeModal');
    }
    public function mount()
    {
        $model = User::find($this->model['id']);
        $this->rakeBack = $model->rake_back_percentage;
        $this->affiliateRake = $model->affiliate_rake_percentage;
    }
}
