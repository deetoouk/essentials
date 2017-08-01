<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Exceptions\Error;

/**
 * Class ObjectType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class ObjectType extends Type
{
    public function validate($attribute, $value)
    {
        if (!is_object($value)) {
            throw new Error(':attribute must be an object', compact('attribute'));
        }
    }

    public function cast($value)
    {
        if (is_object($value)) {
            return $value;
        } elseif (is_array($value)) {
            return (object)$value;
        } elseif (is_string($value)) {
            return (object)json_decode($value);
        }

        throw new Error('Invalid value :value', compact($value));
    }

    public function toPrimitive($value)
    {
        return json_encode($value);
    }
}
