<?php

namespace App\Http\Livewire;

use App\Actions\RejectWithdrawAction;
use App\Filters\WithdrawsFilter;
use App\Models\UserWithdraw;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class WithdrawManagementView extends TableView
{
    protected $paginate = 10;

    public function repository(): \Illuminate\Database\Eloquent\Builder
    {
        return UserWithdraw::query();
    }

//    protected $listeners = [
//        'reloadTable' => 'reload',
//    ];

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            'userName',
            'Wallet',
            'Amount',
            Header::title('Status')->sortBy('status'),
            Header::title('Create At')->sortBy('created_at'),
        ];
    }


    public function row($model): array
    {
        $data = [
            $model->user->username,
            $model->user->wallet_no,
            $model->amount,
            '<p class="' . $this->getStatusColor($model->status->value) . '">' . $this->getWithdrawStatus($model->status->value) . '</p>',
            $model->created_at->diffforHumans(),
        ];
        return $data;
    }

    /** For actions by item */
    protected function actionsByRow(): array
    {
        return [
            new RejectWithdrawAction(),
        ];
    }

    protected function filters()
    {
        return [
            new WithdrawsFilter(),
        ];
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

//
//    public function reloadTable($type = null): void
//    {
//        $this->render();
//        $this->emit('closeModal');
//        if ($type)
//            $this->emitSelf('notify', [
//                'message' => 'Withdraw Rejected Failed',
//                'type' => $type == 'error' ? 'danger' : 'success'
//            ]);
//    }
}
