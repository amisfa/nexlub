<div class="flex flex-column bold px-1 justify-end" wire:poll.keep-alive>
    <p>{{$user->username}}</p>
    <p>${{number_format($user->balance, 2)}}</p>
</div>
