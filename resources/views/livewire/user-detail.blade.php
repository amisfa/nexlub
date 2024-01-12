<div class="w-full h-auto p-4">
    <div class="flex justify-between items-center">
        <div>Detail of {{$user->username}}</div>
        <div class="p-2 cursor-pointer" wire:click.prevent="$emit('reloadTable')">
            <i class='bx bx-x text-danger text-2xl'></i>
        </div>
    </div>
</div>
