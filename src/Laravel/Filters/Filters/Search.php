<?php

namespace DeeToo\Essentials\Laravel\Filters\Filters;

use DeeToo\Essentials\Laravel\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Search
 *
 * @package DeeToo\Essentials\Laravel\Filters\Filters
 */
class Search extends AbstractFilter
{
    /**
     * @var array
     */
    protected $fields;

    /**
     * Search constructor.
     *
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * @param Builder $query
     * @param $value
     *
     * @return Builder|mixed
     */
    public function apply(Builder $query, $value)
    {
        return $query->where(function ($query) use ($value) {
            foreach ($this->fields as $field) {
                $query = $query->orWhere($field, 'like', $value . '%');
            }
        });
    }
}
