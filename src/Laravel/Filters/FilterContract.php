<?php

namespace DeeToo\Essentials\Laravel\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface FilterContract
 *
 * @package DeeToo\Essentials\Laravel\Filters
 */
interface FilterContract
{
    /**
     * @param Builder $query
     * @param $value
     *
     * @return mixed
     */
    public function apply(Builder $query, $value);
}
