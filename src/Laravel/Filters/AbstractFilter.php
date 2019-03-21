<?php

namespace DeeToo\Essentials\Laravel\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class AbstractFilter
 *
 * @package DeeToo\Essentials\Laravel\Filters
 */
abstract class AbstractFilter implements FilterContract
{
    /**
     * @param Builder $query
     * @param $value
     *
     * @return mixed
     */
    abstract public function apply(Builder $query, $value);
}
