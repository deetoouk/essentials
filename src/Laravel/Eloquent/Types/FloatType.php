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

    public function validate($value)
    {
        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            throw new Error('must be float');
        }

        if (isset($this->max) && $value > $this->max) {
            throw new Error('cannot be more than :max', ['max' => $this->max]);
        }

        if ($this->unsigned && $value < 0) {
            throw new Error('cannot be less than 0');
        }

        if (isset($this->min) && $value < $this->min) {
            throw new Error('cannot be less than :min', ['min' => $this->min]);
        }
    }

    public function castFromPrimitive($value)
    {
        return floatval($value);
    }
}
