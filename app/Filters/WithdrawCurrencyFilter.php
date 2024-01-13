<?php

namespace App\Filters;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

class WithdrawCurrencyFilter extends Filter
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
        return $query->where('currency', $value);
    }

    /**
     * Defines the title and value for each option
     *
     * @return Array associative array with the title and values
     */
    public function options(): array
    {
        $currencies = Helper::getAvailableCurrencies();
        $pseudoCurrencies = array();
        foreach ($currencies as $currency) {
            $pseudoCurrencies[$currency['name']] = $currency['currency'];
        }
        return $pseudoCurrencies;
    }
}
