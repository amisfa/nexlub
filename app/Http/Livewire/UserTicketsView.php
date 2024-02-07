<?php

namespace App\Http\Livewire;

use LaravelViews\Views\TableView;

class UserTicketsView extends TableView
{
    protected $paginate = 10;
    public $searchBy = ['subject'];

    public function repository(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Models\Ticket::query()->where('user_id', auth()->id());
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            'Subject',
            'Status'
        ];
    }

    public function row($model): array
    {
        $data = [
            $model->subject,
            $this->ticketHasResponse($model->comments()->latest()->first()),
        ];
        return $data;
    }

    public static function ticketHasResponse($lastComment): string
    {
        return $lastComment->user->id == auth()->id() ? "Waiting" : "Answered";
    }
}
