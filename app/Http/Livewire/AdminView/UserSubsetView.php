<?php

namespace App\Http\Livewire\AdminView;

use App\Models\User;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class UserSubsetView extends TableView
{
    public $searchBy = ['username'];
    public string|int $userId;

    protected $paginate = 10;

    public function repository()
    {
        return User::query()->where('referrer_id', $this->userId);
    }

    public function headers(): array
    {
        return [
            'UserName',
            'Remain Rake',
            'Claimed Rake',
            'total Rake',
            Header::title('SignUp at')->sortBy('created_at'),
        ];
    }

    public function row($model): array
    {
        return [
            $model->username,
            number_format($model->remain_affiliate_rake),
            number_format($model->claimed_affiliate_rake),
            number_format($model->total_affiliate_rake),
            $model->created_at->diffforHumans()
        ];
    }
}
