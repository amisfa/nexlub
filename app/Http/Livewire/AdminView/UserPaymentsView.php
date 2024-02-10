<?php

namespace App\Http\Livewire\AdminView;

use App\Models\UserPayment;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class UserPaymentsView extends TableView
{
    public $searchBy = ['price_amount', 'price_currency', 'pay_currency'];
    protected $paginate = 10;
    public string|int $userId;

    public function repository(): Builder
    {
        return UserPayment::query()->where('user_id', $this->userId);
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
            'status',
            Header::title('Created')->sortBy('created_at'),
        ];
    }


    public function row($model): array
    {
        return [
            $model->price_amount . ' USD',
            '<p class="' . $this->getStatusColor($model->status) . '">' . $model->status . '</p>',
            $model->created_at->diffforHumans()
        ];
    }

    public static function getStatusColor($status): string
    {
        return $status == "Failed" ? "text-danger" : "text-success";
    }
}
