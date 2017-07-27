<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Exceptions\Error;

/**
 * Class BooleanType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class BooleanType extends Type
{
    function validate($attribute, $value)
    {
        if (!is_bool($value)) {
            throw new Error(':attribute must be boolean', compact('attribute'));
        }
    }

    public function cast($value)
    {
        if (is_bool($value)) {
            return $value;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    public function toPrimitive($value)
    {
        return $value ? 1 : 0;
    }
}
