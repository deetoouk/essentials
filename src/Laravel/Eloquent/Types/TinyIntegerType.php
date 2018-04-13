<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Types;

/**
 * Class TinyIntegerType
 *
 * @package DeeToo\Essentials\Laravel\Eloquent\Types
 */
class TinyIntegerType extends IntegerType
{
    /**
     * @const integer
     */
    protected const TYPE_MAX = (2 ** 7) - 1;

    /**
     * @const integer
     */
    protected const TYPE_MIN = -(2 ** 7);
}
