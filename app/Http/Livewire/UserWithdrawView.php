<?php

namespace App\Http\Livewire;

use App\Models\UserWithdraw;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class UserWithdrawView extends TableView
{
    public $searchBy = ['amount'];
    protected $paginate = 10;

    public function repository(): \Illuminate\Database\Eloquent\Builder
    {
        return UserWithdraw::query()->where('user_id', auth()->id());
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            'UserName',
            Header::title('SignUp at')->sortBy('created_at'),
        ];
    }


    public function row($model): array
    {
        return [
            $model->username,
            $model->created_at->diffforHumans()
        ];
    }
}
