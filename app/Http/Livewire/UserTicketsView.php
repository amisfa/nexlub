<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class UserTicketsView extends TableView
{
    public $searchBy = ['subject'];
    protected $paginate = 10;

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.tickets');
    }

    public function repository(): Builder
    {
        return Ticket::query()->whereNull('thread_id')->where('user_id', auth()->id());
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
            'Category',
            'status',
            'Answered By Admin',
            Header::title('Created')->sortBy('created_at'),
        ];
    }


    public function row($model): array
    {
        return [
            $model->Subject,
            $model->Category,
            $model->closed_at ? 'Closed' : 'Open',
            $model->answered_by_admin ? 'Yes' : 'No',
            $model->created_at->diffforHumans()
        ];
    }
}
