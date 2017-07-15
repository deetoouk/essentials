<?php

namespace JordanDobrev\Essentials\Laravel\Eloquent\Types;

/**
 * Class TextType
 *
 * @package JordanDobrev\Essentials\Laravel\Eloquent\Types
 */
class TextType extends Type
{
    /**
     * @var integer
     */
    public $min;

    /**
     * @var integer
     */
    public $max;

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
