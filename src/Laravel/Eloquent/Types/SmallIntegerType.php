<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Types;

/**
 * Class SmallIntegerType
 *
 * @package DeeToo\Essentials\Laravel\Eloquent\Types
 */
class SmallIntegerType extends IntegerType
{
    /**
     * @const integer
     */
    protected const TYPE_MAX = (2 ** 15) - 1;

    /**
     * @const integer
     */
    protected const TYPE_MIN = -(2 ** 15);
}
