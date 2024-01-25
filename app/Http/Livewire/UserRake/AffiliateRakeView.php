<?php

namespace App\Http\Livewire\UserRake;

use App\Helpers\Helper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AffiliateRakeView extends Component
{
    protected $listeners = ['claimAffiliateRakes' => 'claimAffiliateRakes'];

    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('pages.user-rake.subset');
    }

    public function claimAffiliateRakes(): void
    {
        $remainAffiliateRakes = 0;
        auth()->user()->referrals()->each(function ($q) use (&$remainAffiliateRakes) {
            if ($q->userRake()->exists()) {
                $remainAffiliateRakes += $q->remain_affiliate_rake;
                $q->userRake()->update([
                    'claimed_rake_affiliate' => $remainAffiliateRakes + $q->claimed_affiliate_rake
                ]);
                $q->save();
            }
        });
        Helper::addBalance([
            'user_id' => auth()->id(),
            'amount' => $remainAffiliateRakes,
            'log' => $remainAffiliateRakes . ' USD Claimed Rake Affiliate by ' . auth()->user()->username
        ]);
        $this->emit('reloadTable');
        $this->render();
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.user-rake.affiliate-rake-view');
    }
}
