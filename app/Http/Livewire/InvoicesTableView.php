<?php

namespace App\Http\Livewire;

//use App\Filters\PaymentStatusFilter;
use App\Models\UserInvoice;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class InvoicesTableView extends TableView
{
    public $searchBy = ['price_amount', 'price_currency', 'pay_currency', 'invoice_id'];
    protected $paginate = 10;

    public function repository(): Builder
    {
        return UserInvoice::query()->where('user_id', auth()->id());
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            'Invoice Id',
            'Invoice Address',
            'Price Amount',
            'Payment Currency',
            Header::title('Created')->sortBy('created_at'),
        ];
    }

//    protected function filters()
//    {
//        return [
//            new PaymentStatusFilter,
//        ];
//    }


    public function row($model): array
    {
        return [
            $model->invoice_id,
            '<a href="' . $model->invoice_url . '">' . $model->invoice_url . '</a>',
            $model->price_amount . ' ' . $model->price_currency,
            $model->pay_currency,
            $model->created_at->diffforHumans()
        ];
    }
}
