<?php

namespace App\Http\Livewire\AdminView;

use App\Actions\CloseConversationAction;
use App\Actions\ContinueConversationAction;
use App\Actions\OpenConversationAction;
use App\Filters\TicketStatusFilter;
use App\Filters\TicketTypeFilter;
use Carbon\Carbon;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class TicketManagementView extends TableView
{
    protected $paginate = 10;

    public $searchBy = ['subject', 'user.username'];

    protected $listeners = ['reloadUserTickets' => 'refresh'];

    public function repository(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Models\Ticket::query();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            'userName',
            'Subject',
            'Status',
            Header::title('Created')->sortBy('created_at'),
            Header::title('Updated')->sortBy('updated_at'),
            Header::title('Closed')->sortBy('closed_at'),
        ];
    }

    public function row($model): array
    {
        $data = [
            $model->user->username,
            $model->subject,
            $this->ticketHasResponse($model->latestComment()->first()),
            $model->created_at->diffforHumans(),
            $model->updated_at->diffforHumans(),
            $model->closed_at ? Carbon::parse($model->closed_at)->diffforHumans() : 'Not Closed',
        ];
        return $data;
    }

    protected function filters()
    {
        return [
            new TicketTypeFilter(),
            new TicketStatusFilter(),
        ];
    }


    /** For actions by item */
    protected function actionsByRow(): array
    {
        return [
            new ContinueConversationAction(),
            new CloseConversationAction(),
            new OpenConversationAction()
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
