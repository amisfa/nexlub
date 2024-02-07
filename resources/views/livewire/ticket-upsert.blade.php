<div>
    <div class="h-full p-8 flex justify-between items-center pb-3">
        <div>
            @if($ticket)
                Add Comment
            @else
                Create Ticket
            @endif
        </div>
        <div class="p-2 cursor-pointer" wire:click.prevent="$emit('closeModal')">
            <i class='bx bx-x text-danger text-2xl'></i>
        </div>
    </div>
    @if($ticket)
        <div>test</div>
    @else
        <div class="p-8">
            <form wire:submit.prevent="createTicket">
                <div class="form-group">
                    <label>Subject</label>
                    <input class="form-control" wire:model="subject" autocomplete="off" maxlength="255" required>
                </div>
                <div class="form-group">
                    <label>Comment</label>
                    <textarea class="form-control" wire:model="comment" required></textarea>
                </div>
                <button id="submit" type="submit" class="btn">Create</button>
            </form>
        </div>
    @endif
</div>
