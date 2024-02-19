<div class="overflow-auto beauty-scroll mb-3" style="{{$ticket ? 'height: 85vh;':''}}">
    <div class="p-8 flex justify-between items-center pb-2">
        <div>
            @if($ticket)
                <div>Subject:</div>
                <p class="font-bold">{{$ticket->subject}}</p>
            @else
                Create Ticket
            @endif
        </div>
        <div class="p-2 cursor-pointer" wire:click.prevent="$emit('closeModal')">
            <i class='bx bx-x text-danger text-2xl'></i>
        </div>
    </div>
    @if($ticket)
        <div class="flex flex-col px-2" style="height: 80%">
            <div class="flex sm:flex-row justify-between pt-2">
                <div>Created At: {{$ticket->created_at->diffforHumans()}}</div>
                <div>Updated At: {{$ticket->updated_at->diffforHumans()}}</div>
            </div>
            <div class="border-solid border-2 rounded p-2 overflow-auto flex flex-col h-full beauty-scroll"
                 style="border-color: #22C9E9;">
                @foreach($ticket->comments()->get() as $comment)
                    <div class="flex p-1 flex-col sm:flex-row flex" style="{{
    $comment->user->id == auth()->id() ?
    "justify-content:end;":
    "justify-content:start;"
    }}"><div class="p-2" style="{{
    $comment->user->id == auth()->id() ?
    "border-radius: 10px 0px 10px 10px;float:right;border: 1px solid #22C9E9":
    "border-radius: 0px 10px 10px 10px;float:left;border: 1px solid #22C9E9"
    }}">{{$comment->comment}}</div>
                    </div>
                @endforeach
            </div>
        </div>
        @if(!$ticket->closed_at)
            <div class="p-2">
                <form wire:submit.prevent="addComment">
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea class="form-control beauty-scroll" wire:model="comment" required></textarea>
                    </div>
                    <button id="submit" type="submit" class="btn float-right">Send</button>
                </form>
            </div>
        @else
            <h4 class="text-center text-danger py-2">This Ticket Closed at {{$ticket->created_at->diffforHumans()}}</h4>
        @endif

    @else
        <div class="p-8">
            <form wire:submit.prevent="createTicket">
                <div class="form-group">
                    <label>Subject</label>
                    <input class="form-control" wire:model="subject" autocomplete="off" maxlength="255" required>
                </div>
                <div class="form-group">
                    <label>Comment</label>
                    <textarea class="form-control beauty-scroll" wire:model="comment" required></textarea>
                </div>
                <button id="submit" type="submit" class="btn float-right">Send</button>
            </form>
        </div>
    @endif
</div>
