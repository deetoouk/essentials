<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Exceptions\Error;

/**
 * Class IntegerType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
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

    public function validate($attribute, $value)
    {
        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
            throw new Error(':attribute must be integer', compact('attribute'));
        }

        if (isset($this->max) && $value > $this->max) {
            throw new Error(
                ':attribute cannot be more than :max',
                compact('attribute') + ['max' => $this->max]
            );
        }

        if (isset($this->min) && $value < $this->min) {
            throw new Error(
                ':attribute cannot be less than :min',
                compact('attribute') + ['min' => $this->min]
            );
        }

        if ($this->unsigned) {
            if ($value < 0) {
                throw new Error(
                    ':attribute cannot be less than 0',
                    compact('attribute')
                );
            }

            $unsigned_max = self::TYPE_MAX + abs(self::TYPE_MIN);

            if ($value > $unsigned_max) {
                throw new Error(
                    ':attribute cannot be more than :max',
                    compact('attribute') + ['max' => $unsigned_max]
                );
            }
        } else {
            if ($value < self::TYPE_MIN) {
                throw new Error(
                    ':attribute cannot be less than :min',
                    compact('attribute') + ['min' => self::TYPE_MIN]
                );
            }

            if ($value > self::TYPE_MAX) {
                throw new Error(
                    ':attribute cannot be more than :max',
                    compact('attribute') + ['max' => self::TYPE_MAX]
                );
            }
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
