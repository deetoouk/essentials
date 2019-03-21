<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Traits;

use DeeToo\Essentials\Laravel\Filters\Filter;

/**
 * Trait Filterable
 *
 * @package DeeToo\Essentials\Laravel\Eloquent\Traits
 */
trait Filterable
{
    /**
     * @return array|null
     */
    abstract protected function filters(): ?array;

    /**
     * @param $query
     * @param iterable|null $filters
     *
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws \DeeToo\Essentials\Exceptions\Fatal
     * @throws \DeeToo\Essentials\Laravel\Filters\FilterException
     */
    public function scopeFilter($query, ?iterable $filters)
    {
        if (!$filters) {
            return $query;
        }

        return (new Filter())->apply($query, $this->filters(), $filters);
    }
}
