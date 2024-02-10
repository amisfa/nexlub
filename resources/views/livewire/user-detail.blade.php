<div class="w-full h-auto p-4">
    <div class="flex justify-between items-center">
        <div>Detail of {{$user->username}}</div>
        <div class="p-2 cursor-pointer" wire:click.prevent="$emit('closeModal')">
            <i class='bx bx-x text-danger text-2xl'></i>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="py-2 flex">
            <div class="text-white font-bold pr-2">
                Username:
            </div>
            {{$user->username}}
        </div>
        <div class="py-2 flex">
            <div class="text-white font-bold pr-2">
                Email:
            </div> {{$user->email}} ({{$user->email_verified_at? 'Verified': 'Unverified'}})
        </div>
        <div class="py-2 flex">
            <div class="text-white font-bold pr-2">
                Affiliate Rake:
            </div> {{$user->affiliate_rake_percentage}}%
        </div>
        <div class="py-2 flex">
            <div class="text-white font-bold pr-2">
                Rake Back:
            </div>{{$user->rake_back_percentage}}%
        </div>
        <div class="py-2 flex">
            <div class="text-white font-bold pr-2">
                Balance:
            </div>{{number_format($user->balance)}} USD
        </div>
        <div class="py-2 flex">
            <div class="text-white font-bold pr-2">
                Banned:
            </div>{{$user->banned_id ? 'Yes' : 'No'}}
        </div>
    </div>
</div>
