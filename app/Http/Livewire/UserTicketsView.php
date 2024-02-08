<?php

namespace App\Http\Livewire;

use App\Actions\ContinueConversationAction;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class UserTicketsView extends TableView
{
    protected $paginate = 10;
    public $searchBy = ['subject'];

    protected $listeners = ['reloadUserTickets' => 'refresh'];

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
            'Status',
            Header::title('Created')->sortBy('created_at'),
            Header::title('Updated')->sortBy('created_at'),
        ];
    }

    public function row($model): array
    {
        $data = [
            $model->subject,
            $this->ticketHasResponse($model->comments()->latest()->first()),
            $model->created_at->diffforHumans(),
            $model->updated_at->diffforHumans(),
        ];
        return $data;
    }

    /** For actions by item */
    protected function actionsByRow(): array
    {
        return [
            new ContinueConversationAction(),
        ];
    }

    public static function ticketHasResponse($lastComment): string
    {
        return $lastComment->user->id == auth()->id() ? "Waiting" : "Answered";
    }

    public function refresh(): void
    {
        $this->render();
    }
}
