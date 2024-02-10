<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class TicketUpsert extends ModalComponent
{

    public array $model = [];
    public ?string $subject = null;
    public ?string $comment = null;

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $ticket = null;
        if (count($this->model)) $ticket = \App\Models\Ticket::find($this->model['id']);
        return view('livewire.ticket-upsert', ['ticket' => $ticket]);
    }

    public function createTicket(): void
    {
        $ticket = \App\Models\Ticket::query()->create([
            'user_id' => auth()->id(),
            'subject' => $this->subject
        ]);
        $ticket->comments()->create([
            'comment' => $this->comment,
            'user_id' => auth()->id()
        ]);
        $this->emit('reloadUserTickets');
        $this->emit('closeModal');
    }

    public function addComment(): void
    {
        $ticket = \App\Models\Ticket::find($this->model['id']);
        $ticket->updated_at = now();
        $ticket->save();
        $ticket->comments()->create([
            'comment' => $this->comment,
            'user_id' => auth()->id()
        ]);
        $this->emit('closeModal');
        $this->render();
    }
}
