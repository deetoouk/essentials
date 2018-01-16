<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Exceptions\Error;

/**
 * Class StringType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class StringType extends Type
{
    /**
     * @var integer
     */
    public $min;

    /**
     * @var integer
     */
    public $max = 255;

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
        if (!is_scalar($value)) {
            throw new Error('must be a string');
        }
    }

    public function castToPrimitive($value)
    {
        return strval($value);
    }
}
