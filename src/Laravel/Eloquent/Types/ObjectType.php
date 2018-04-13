<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Types;

use DeeToo\Essentials\Exceptions\Error;

/**
 * Class ObjectType
 *
 * @package DeeToo\Essentials\Laravel\Eloquent\Types
 */
class ObjectType extends Type
{
    public function validate($value)
    {
        if (!is_object($value) && !is_array($value)) {
            throw new Error('must be an object');
        }
    }

    public function castFromPrimitive($value)
    {
        return (object)json_decode($value);
    }

    public function castToPrimitive($value)
    {
        return json_encode($value);
    }
}
