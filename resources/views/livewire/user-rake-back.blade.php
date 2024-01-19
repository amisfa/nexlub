<div class="p-3">
    <div class="p-4">
        @if($user->userRake)
            <div class="flex justify-between">
                <div class="text-success">Remain Rake Back</div>
                <div class="text-warning">{{$user->remain_rake_back}} USD</div>
            </div>
            <br/>
            <div class="flex justify-between">
                <div class="text-success">Claimed Rake Back</div>
                <div class="text-warning">{{$user->claimed_rake_back}} USD</div>
            </div>
            <br/>
            <div class="flex justify-between">
                <div class="text-success">Total Rake Back</div>
                <div class="text-warning">{{$user->total_rake_back}} USD</div>
            </div>
            <br/>
            <div class="form-group row justify-end">
                <button type="submit" class="btn btn-primary" wire:click.prevent="claim">Claim</button>
            </div>
        @else
            <div class="text-danger">You Need to Play More!</div>
        @endif
    </div>
</div>
