<?php

namespace App\Http\Livewire;

use App\Actions\UserDetailAction;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class UserManagementView extends TableView
{
    protected $listeners = [
        'render' => '$refresh',
    ];

    public $searchBy = ['username', 'email', 'wallet_no', 'balance'];
    protected $paginate = 10;

    public function repository(): Builder
    {
        return User::query();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            'User Name',
            'Email',
            'Wallet',
            'Balance',
            Header::title('Created')->sortBy('created_at'),
        ];
    }

    public function actionsByRow(): array
    {
        return [
            new UserDetailAction()
        ];
    }

    public function row($model): array
    {
        return [
            $model->username,
            $model->email,
            $model->wallet_no,
            $model->balance,
            $model->created_at->diffforHumans()
        ];
    }
}
