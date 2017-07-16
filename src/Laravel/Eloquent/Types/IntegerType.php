<?php

namespace JordanDobrev\Essentials\Laravel\Eloquent\Types;

use JordanDobrev\Essentials\Exceptions\Error;

/**
 * Class IntegerType
 *
 * @package JordanDobrev\Essentials\Laravel\Eloquent\Types
 */
class IntegerType extends Type
{
    /**
     * @var integer
     */
    public $unsigned;

    /**
     * @var integer
     */
    public $min;

    /**
     * @var integer
     */
    public $max;

    /**
     * @param bool $unsigned
     *
     * @return $this
     */
    public function unsigned(boolean $unsigned = true)
    {
        $this->unsigned = $unsigned;

        return $this;
    }

    /**
     * @param int $max
     *
     * @return $this
     */
    public function max(integer $max)
    {
        $this->max = $max;

        return $this;
    }

    /**
     * @param int $min
     *
     * @return $this
     */
    public function min(integer $min)
    {
        $this->min = $min;

        return $this;
    }

    function validate($attribute, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_INT)) {
            throw new Error(':attribute must be an integer');
        }
    }

    public function cast($value)
    {
        if (is_int($value)) {
            return $value;
        }

        return intval($value);
    }
}
