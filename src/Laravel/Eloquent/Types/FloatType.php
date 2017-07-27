<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Exceptions\Error;

/**
 * Class FloatType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class FloatType extends Type
{
    /**
     * @var bool
     */
    public $unsigned;

    /**
     * @var float
     */
    public $min;

    /**
     * @var float
     */
    public $max;

    /**
     * @param bool $unsigned
     *
     * @return $this
     */
    public function unsigned(bool $unsigned = true)
    {
        $this->unsigned = $unsigned;

        return $this;
    }

    /**
     * @param float $max
     *
     * @return $this
     */
    public function max(float $max)
    {
        $this->max = $max;

        return $this;
    }

    /**
     * @param float $min
     *
     * @return $this
     */
    public function min(float $min)
    {
        $this->min = $min;

        return $this;
    }

    function validate($attribute, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_FLOAT)) {
            throw new Error(':attribute must be an float');
        }
    }

    public function cast($value)
    {
        if (is_float($value)) {
            return $value;
        }

        return floatval($value);
    }
}
