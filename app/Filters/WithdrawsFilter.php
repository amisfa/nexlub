<?php

namespace App\Filters;

use App\Enums\CashOutStatuses;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

class WithdrawsFilter extends Filter
{
    /**
     * Modify the current query when the filter is used
     *
     * @param Builder $query Current query
     * @param $value Value selected by the user
     * @return Builder Query modified
     */
    public function apply(Builder $query, $value, $request): Builder
    {
        return $query->where('status', $value);
    }

    /**
     * Defines the title and value for each option
     *
     * @return Array associative array with the title and values
     */
    public function options(): array
    {
        return [
            'Paid' => CashOutStatuses::Paid,
            'Waiting' => CashOutStatuses::Waiting,
            'Rejected' => CashOutStatuses::Rejected,
            'Canceled' => CashOutStatuses::Canceled
        ];
    }
}
