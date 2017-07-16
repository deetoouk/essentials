<?php

namespace JordanDobrev\Essentials\Laravel\Eloquent\Types;

use JordanDobrev\Essentials\Exceptions\Error;

/**
 * Class ArrayType
 *
 * @package JordanDobrev\Essentials\Laravel\Eloquent\Types
 */
class ArrayType extends Type
{
    public function validate($attribute, $value)
    {
        if (!is_array($value)) {
            throw new Error(':attribute must be an array');
        }
    }

    public function cast($value)
    {
        if (is_array($value)) {
            return $value;
        }

        return json_decode($value, true);
    }

    public function toPrimitive($value)
    {
        return json_encode($value);
    }
}
