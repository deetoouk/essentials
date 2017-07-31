<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

/**
 * Class BigIntegerType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class BigIntegerType extends IntegerType
{
    /**
     * @const integer
     */
    protected const TYPE_MAX = (2 ** 63) - 1;

    /**
     * @const integer
     */
    protected const TYPE_MIN = -(2 ** 63);
}
