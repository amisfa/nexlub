<div class="w-full h-auto p-4">
    <div class="flex justify-between items-center">
        <div>Change Percentage for {{$user->username}}</div>
        <div class="p-2 cursor-pointer" wire:click.prevent="$emit('reloadTable')">
            <i class='bx bx-x text-danger text-2xl'></i>
        </div>
    </div>
    <form wire:submit.prevent="change">
        <div class="form-group">
            <label>Rake back Percentage</label>
            <input type="number" class="form-control" wire:model="rakeBack"
                   autocomplete="off">
        </div>
        <div class="form-group">
            <label>Affiliate Rake Percentage</label>
            <input type="number" class="form-control"
                   wire:model="affiliateRake">
        </div>
        <button id="submit" type="submit" class="btn">Save</button>
    </form>
</div>
