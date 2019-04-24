<?php

namespace DeeToo\Essentials\Laravel\Filters\Filters;

use DeeToo\Essentials\Exceptions\Error;
use DeeToo\Essentials\Laravel\Filters\AbstractFilter;
use DeeToo\Essentials\Laravel\Filters\Types;
use Illuminate\Database\Eloquent\Builder;

class InArray extends AbstractFilter
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
     * @throws Error
     */
    public function apply(Builder $query, $value)
    {
        if (!is_array($value)) {
            throw new Error('In Array filter accept only arrays!');
        }

        $casted = [];

        foreach ($value as $v) {
            $casted[] = Types::cast($v, $this->type);
        }

        return $query->whereIn($this->field, $casted);
    }
}
