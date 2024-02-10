<?php

namespace App\Http\Livewire\UserRake;

use App\Actions\ClaimJackPotAction;
use App\Models\UserJackPotReward;
use Carbon\Carbon;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class JackPotRewardView extends TableView
{
    public function create()
    {
        return view('pages.user-rake.user-jack-pot');
    }

    protected $paginate = 10;

    protected $listeners = ['reloadUserJackPots' => 'refresh'];

    public function repository(): \Illuminate\Database\Eloquent\Builder
    {
        return UserJackPotReward::query()->where('user_id', auth()->id());
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            'amount',
            Header::title('Claimed At')->sortBy('claimed_at'),
            Header::title('Win At')->sortBy('created_at'),
        ];
    }

    public function row($model): array
    {
        return [
            number_format($model->amount),
            $model->claimed_at ? Carbon::parse($model->claimed_at)->diffforHumans() : 'Not Claimed',
            $model->created_at->diffforHumans(),
        ];
    }

    /** For actions by item */
    protected function actionsByRow(): array
    {
        return [
            new ClaimJackPotAction(),
        ];
    }

    public function refresh(): void
    {
        $this->render();
    }
}
