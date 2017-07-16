<?php

namespace JordanDobrev\Essentials\Laravel\Eloquent\Types;

use JordanDobrev\Essentials\Exceptions\Error;

/**
 * Class ObjectType
 *
 * @package JordanDobrev\Essentials\Laravel\Eloquent\Types
 */
class ObjectType extends Type
{
    function validate($attribute, $value)
    {
        if (!is_object($value)) {
            throw new Error(':attribute must be an object');
        }
    }

    public function cast($value)
    {
        if (is_object($value)) {
            return $value;
        }
        
        return (object)json_decode($value);
    }

    public function toPrimitive($value)
    {
        return json_encode($value);
    }
}
