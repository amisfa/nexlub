<div class="card-header">
    <div class="flex justify-start sm:flex-row flex-col sm:items-end items-center">
        <div class="shareLink">
            Invite Link:
            <div class="permalink">
                <input class="textLink" type="text" name="shortlink"
                       value="{{auth()->user()->referral_link}}" id="text"
                       readonly="">
                <span class="copyLink" id="copy" tooltip="Copy to clipboard">
                                        <i class="fa-regular fa-copy"></i>
                                    </span>
            </div>
        </div>
        @if(auth()->user()->referrals()->exists())
            <button class="btn btn-fill btn-primary mb-0 sm:ml-2"
                    wire:click="$emit('claimAffiliateRakes')">{{ __('Claim Rakes') }}</button>
        @endif
    </div>
</div>
<livewire:user-subset-view/>
