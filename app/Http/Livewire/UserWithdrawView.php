<?php

namespace App\Http\Livewire;

use App\Actions\CancelWithdrawAction;
use App\Enums\WithdrawStatuses;
use App\Filters\WithdrawsStatusFilter;
use App\Models\UserWithdraw;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class UserWithdrawView extends TableView
{
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
            'Amount',
            'Payment Currency',
            Header::title('Status')->sortBy('status'),
            Header::title('Create At')->sortBy('created_at'),
            'Rejection Reason',
            'TX URL'
        ];
    }


    public function row($model): array
    {
        $data = [
            $model->amount . ' USD',
            $model->currency,
            '<p class="' . $this->getStatusColor($model->status->value) . '">' . $this->getWithdrawStatus($model->status->value) . '</p>',
            $model->created_at->diffforHumans(),
            $model->rejected_comment,
        ];
        if ($model->status === WithdrawStatuses::Paid) $data[] = '<a href="' . $model->tx_url . '" target="_blank">Tx Link<i class="bx bx-link-external"></i>';
        return $data;
    }

    public static function getStatusColor($status)
    {
        switch ($status) {
            case 1:
                return "text-warning";
            case 2:
                return "text-success";
            case 3:
            case 4:
                return "text-danger";
        }
    }

    public function getWithdrawStatus($status)
    {
        switch ($status) {
            case 1:
                return "Waiting";
            case 2:
                return "Paid";
            case 3:
                return "Canceled";
            case 4:
                return "Rejected";
        }
    }

    /** For actions by item */
    protected function actionsByRow(): array
    {
        return [
            new CancelWithdrawAction(),
        ];
    }

    protected function filters()
    {
        return [
            new WithdrawsStatusFilter(),
        ];
    }
}
