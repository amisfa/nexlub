<?php

namespace App\Http\Livewire\AdminView;

use App\Helpers\Helper;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class UserRakePercentageView extends ModalComponent
{
    public array $model;
    public int $rakeBack;
    public int|string $affiliateRake;

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $model = User::find($this->model['id']);
        return view('livewire.user-rake-percentage', ['user' => $model]);
    }

    public function mount()
    {
        $model = User::find($this->model['id']);
        $this->rakeBack = $model->rake_back_percentage;
        $this->affiliateRake = $model->affiliate_rake_percentage;
    }

    public function change()
    {
        $model = User::find($this->model['id']);

        $currentRakeBack = $model->rake_back_percentage;
        $currentAffiliateRake = $model->affiliate_rake_percentage;
        $remainRakeBack = $model->remain_rake_back;
        if ($currentRakeBack != $this->rakeBack) {
            $model->rake_back_percentage = $this->rakeBack;
            if ($model->userRake()->exists()) {
                $query = $model->userRake();
                $query->update([
                    'claimed_rake_back' => (($this->rakeBack / 100) * $model->userRake->rake) - $remainRakeBack
                ]);
            }
        }
        if ($currentAffiliateRake != $this->affiliateRake) {
            $model->affiliate_rake_percentage = $this->affiliateRake;
            $model->referrals()->each(function ($q) {
                if ($q->userRake()->exists()) {
                    $remainAffiliateRake = $q->remain_affiliate_rake;
                    $query = $q->userRake();
                    $claimedRakeAffiliate = (($this->affiliateRake / 100) * $q->userRake->rake);
                    $query->update([
                        'claimed_rake_affiliate' => $claimedRakeAffiliate >= $remainAffiliateRake ? $claimedRakeAffiliate - $remainAffiliateRake : $claimedRakeAffiliate
                    ]);
                    if ($claimedRakeAffiliate < $remainAffiliateRake) {
                        dd($q->id, floatval($remainAffiliateRake));
                        Helper::addBalance([
                            'user_id' => $q->id,
                            'amount' => floatval($remainAffiliateRake),
                            'log' => $remainAffiliateRake . ' USD Added in Change percentage ' . $q->username
                        ]);
                    }
                }
            });
        }
        $model->save();
        $this->emit('closeModal');
    }
}
