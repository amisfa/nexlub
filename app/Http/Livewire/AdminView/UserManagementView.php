<?php

namespace App\Http\Livewire\AdminView;

use App\Actions\BanUserAction;
use App\Actions\UnBanUserAction;
use App\Actions\UserDetailAction;
use App\Actions\UserPaymentsAction;
use App\Actions\UserPercentageAction;
use App\Actions\UserWithdrawsAction;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class UserManagementView extends TableView
{
    public $searchBy = ['username', 'email', 'wallet_no', 'balance'];
    protected $paginate = 10;
    protected $listeners = ['reloadTable' => 'reload'];

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
            Header::title('Affiliate Per')->sortBy('affiliate_rake_percentage'),
            Header::title('Created')->sortBy('created_at'),
        ];
    }

    public function actionsByRow(): array
    {
        return [
            new UserDetailAction(),
            new UserWithdrawsAction(),
            new UserPaymentsAction(),
            new UserPercentageAction(),
            new BanUserAction(),
            new UnBanUserAction(),
        ];
    }

    public function row($model): array
    {
        return [
            $model->username,
            $model->email,
            substr($model->wallet_no, 0, 6) . '...' . substr($model->wallet_no, -4, strlen($model->wallet_no)),
            $model->balance,
            $model->affiliate_rake_percentage,
            $model->created_at->diffforHumans()
        ];
    }

    public function reload(): void
    {
        $this->render();
        $this->emit('closeModal');
    }
}
