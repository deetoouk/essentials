<?php

namespace DeeToo\Essentials\Laravel\Filters\Filters;

use DeeToo\Essentials\Laravel\Filters\AbstractFilter;
use DeeToo\Essentials\Laravel\Filters\Types;
use Illuminate\Database\Eloquent\Builder;

class Equals extends AbstractFilter
{
    /**
     * @var string
     */
    protected $field;

    /**
     * @var string
     */
    protected $type;

    /**
     * Equals constructor.
     *
     * @param string $field
     * @param string $type
     */
    public function __construct(string $field, string $type = 'string')
    {
        $this->field = $field;
        $this->type  = $type;
    }

    /**
     * @param Builder $query
     * @param $value
     *
     * @return Builder|mixed
     */
    public function apply(Builder $query, $value)
    {
        return $query->where($this->field, Types::cast($value, $this->type));
    }
}
