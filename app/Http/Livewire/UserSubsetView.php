<?php

namespace App\Http\Livewire;

use App\Models\User;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class UserSubsetView extends TableView
{
    public $searchBy = ['username'];
    protected $paginate = 10;
    protected $listeners = ['reloadTable' => 'reload'];

    public function repository()
    {
        return User::query()->where('referrer_id', auth()->id());
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

    public function reload(): void
    {
        $this->emit('reloadBalance');
        $this->render();
    }
}
