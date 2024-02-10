<div class="w-full h-auto p-2">
    <div class="flex justify-between items-center">
        <div>Withdraw of {{$user->username}}</div>
        <div class="p-2 cursor-pointer" wire:click.prevent="$emit('closeModal')">
            <i class='bx bx-x text-danger text-2xl'></i>
        </div>
    </div>
    <livewire:admin-view.user-payments-view :userId="$user->id"/>
</div>
