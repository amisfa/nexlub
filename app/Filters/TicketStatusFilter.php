<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

class TicketStatusFilter extends Filter
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
        if ($value) {
            if ($value == 'waiting')
                $query->whereHas('latestComment', function ($q) use ($value) {
                    return $q->where('user_id', auth()->id());
                });
            if ($value == 'answered')
                $query->whereHas('latestComment', function ($q) use ($value) {
                    return $q->whereNot('user_id', auth()->id());
                });
        }
        return $query;
    }

    /**
     * Defines the title and value for each option
     *
     * @return Array associative array with the title and values
     */
    public function options(): array
    {
        return [
            'Answered' => 'answered',
            'Waiting' => 'waiting',
        ];
    }
}
