<?php

namespace JordanDobrev\Essentials\Laravel\Eloquent\Types;

/**
 * Class PercentageType
 *
 * @package JordanDobrev\Essentials\Laravel\Eloquent\Types
 */
class PercentageType extends Type
{
    /**
     * @var float
     */
    public $min = 0;

    /**
     * @var float
     */
    public $max = 100;

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
}
