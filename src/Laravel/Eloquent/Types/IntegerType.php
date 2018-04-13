<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Types;

use DeeToo\Essentials\Exceptions\Error;

/**
 * Class IntegerType
 *
 * @package DeeToo\Essentials\Laravel\Eloquent\Types
 */
class IntegerType extends Type
{
    /**
     * @var bool
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
     * @const integer
     */
    protected const TYPE_MAX = (2 ** 31) - 1;

    /**
     * @const integer
     */
    protected const TYPE_MIN = -(2 ** 31);

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
     * @param int $max
     *
     * @return $this
     */
    public function max(int $max)
    {
        $this->max = $max;

        return $this;
    }

    /**
     * @param int $min
     *
     * @return $this
     */
    public function min(int $min)
    {
        $this->min = $min;

        return $this;
    }

    public function validate($value)
    {
        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
            throw new Error('must be integer');
        }

        if (isset($this->max) && $value > $this->max) {
            throw new Error('cannot be more than :max', ['max' => $this->max]);
        }

        if (isset($this->min) && $value < $this->min) {
            throw new Error('cannot be less than :min', ['min' => $this->min]);
        }

        if ($this->unsigned) {
            if ($value < 0) {
                throw new Error('cannot be less than 0');
            }

            $unsigned_max = self::TYPE_MAX + abs(self::TYPE_MIN);

            if ($value > $unsigned_max) {
                throw new Error('cannot be more than :max', ['max' => $unsigned_max]);
            }
        } else {
            if ($value < self::TYPE_MIN) {
                throw new Error('cannot be less than :min', ['min' => self::TYPE_MIN]);
            }

            if ($value > self::TYPE_MAX) {
                throw new Error('cannot be more than :max', ['max' => self::TYPE_MAX]);
            }
        }
    }

    public function castFromPrimitive($value)
    {
        return intval($value);
    }
}
