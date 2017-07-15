<?php

namespace JordanDobrev\Essentials\Laravel\Eloquent\Types;

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
}
