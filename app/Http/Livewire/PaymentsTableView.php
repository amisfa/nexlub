<?php

namespace App\Http\Livewire;

use App\Models\UserPayment;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class PaymentsTableView extends TableView
{
    public $searchBy = ['price_amount', 'price_currency', 'pay_currency'];
    protected $paginate = 10;

    public function repository(): Builder
    {
        return UserPayment::query()->where('user_id', auth()->id());
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            'Price Amount',
            'Payment Currency',
            Header::title('Created')->sortBy('created_at'),
        ];
    }


    public function row($model): array
    {
        return [
            $model->price_amount . ' ' . $model->price_currency,
            $model->pay_currency,
            $model->created_at->diffforHumans()
        ];
    }
}
