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

    public function validate($attribute, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_FLOAT)) {
            throw new Error(':attribute must be float', compact('attribute'));
        }

        if (isset($this->max) && $value > $this->max) {
            throw new Error(
                ':attribute cannot be more than :max',
                compact('attribute') + ['max' => $this->max]
            );
        }

        if ($this->unsigned && $value < 0) {
            throw new Error(
                ':attribute cannot be less than 0',
                compact('attribute')
            );
        }

        if (isset($this->min) && $value < $this->min) {
            throw new Error(
                ':attribute cannot be less than :min',
                compact('attribute') + ['min' => $this->min]
            );
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
