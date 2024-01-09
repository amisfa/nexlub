<?php

namespace App\Http\Livewire;

use App\Models\UserList;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class UsersListTableView extends TableView
{
    public $searchBy = ['userName', 'email', 'wallet_no', 'balance'];
    protected $paginate = 10;

    public function repository(): Builder
    {
        return UsersList::query()->load('user_id', auth()->id());
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            'User Name' => 'userName',
            'Email' => 'email',
            'Wallet_No' => 'wallet_no',
            'Balance' => 'balance',
            Header::title('Created')->sortBy('created_at'),
        ];
    }


    public function row($model): array
    {
        return [
            $model->userName . 'name',
            '<p class="' . $this->getStatusColor($model->status) . '">' . $model->status . '</p>',
            $model->created_at->diffforHumans()
        ];
    }

    public static function getStatusColor($status): string
    {
        return $status == "Failed" ? "text-danger" : "text-success";
    }
}
