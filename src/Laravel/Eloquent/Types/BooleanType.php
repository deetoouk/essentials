<?php

namespace JordanDobrev\Essentials\Laravel\Eloquent\Types;

use JordanDobrev\Essentials\Exceptions\Error;

/**
 * Class BooleanType
 *
 * @package JordanDobrev\Essentials\Laravel\Eloquent\Types
 */
class BooleanType extends Type
{
    function validate($attribute, $value)
    {
        if (!is_bool($value)) {
            throw new Error(':attribute must be boolean');
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
