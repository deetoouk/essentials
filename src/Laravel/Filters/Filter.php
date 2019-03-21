<?php

namespace DeeToo\Essentials\Laravel\Filters;

use DeeToo\Essentials\Exceptions\Fatal;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Filter
 *
 * @package DeeToo\Essentials\Laravel\Filters
 */
class Filter
{
    /**
     * @param Builder $query
     * @param iterable $availableFilter
     * @param iterable $filters
     *
     * @return Builder
     * @throws Fatal
     * @throws FilterException
     */
    public function apply(Builder $query, ?iterable $availableFilter, ?iterable $filters): Builder
    {
        if (!$filters || !$availableFilter) {
            return $query;
        }

        foreach ($filters as $name => $value) {
            $filter = $availableFilter[$name] ?? null;

            if (!$filter) {
                throw new FilterException('Invalid filter name :name', compact('name'));
            }

            if (!$filter instanceof FilterContract) {
                throw new Fatal('Filter :name must implement FilterContract', compact('name'));
            }

            $query = $filter->apply($query, $value);
        }

        return $query;
    }
}
