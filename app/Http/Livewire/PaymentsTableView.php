<?php

namespace App\Http\Livewire;

use App\Filters\PaymentStatusFilter;
use App\Models\UserPayment;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class PaymentsTableView extends TableView
{
    public $searchBy = ['payment_id', 'pay_address', 'status'];
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
            'Payment Id',
            'Payment Address',
            'Price Amount',
            'Payment Amount',
            Header::title('Status')->sortBy('status'),
            Header::title('Created')->sortBy('created_at'),
        ];
    }

    protected function filters()
    {
        return [
            new PaymentStatusFilter,
        ];
    }


    public function row($model): array
    {
        return [
            $model->payment_id,
            $model->pay_address,
            $model->price_amount . ' ' . $model->price_currency,
            $model->pay_amount . ' ' . $model->pay_currency,
            ucfirst($model->status),
            $model->created_at->diffforHumans()
        ];
    }
}
