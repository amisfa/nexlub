<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

class PaymentStatusFilter extends Filter
{
    public function apply(Builder $query, $value, $request): Builder
    {
        return $query->where('status', $value);
    }

    public function options(): array
    {
        return [
            'Waiting' => "waiting",
            'Confirming' => "confirming",
            'Confirmed' => "confirming",
            'sending' => "sending",
            'Partially Paid' => "partially_paid",
            'Finished' => "finished",
            'Failed' => "failed",
            'Expired' => "expired",
        ];
    }
}
