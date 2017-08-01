<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Exceptions\Error;

/**
 * Class ArrayType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class ArrayType extends Type
{
    public function validate($attribute, $value)
    {
        if (!is_array($value)) {
            throw new Error(':attribute must be an array', compact('attribute'));
        }
    }

    public function cast($value)
    {
        if (is_array($value)) {
            return $value;
        } elseif (is_string($value)) {
            return json_decode($value, true);
        }

        throw new Error('Invalid value :value', compact('value'));
    }

    public function toPrimitive($value)
    {
        return json_encode($value);
    }
}
