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
    public function validate($value)
    {
        if (!is_array($value)) {
            throw new Error('must be an array');
        }
    }

    public function castFromPrimitive($value)
    {
        return json_decode($value, true);
    }

    public function castToPrimitive($value)
    {
        return json_encode($value);
    }
}
