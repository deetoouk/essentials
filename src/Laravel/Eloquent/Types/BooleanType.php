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
    public function validate($value)
    {
        if (filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === null) {
            throw new Error('must be boolean');
        }
    }

    public function castFromPrimitive($value)
    {
        if ($value === '1') return true;
        if ($value === 1) return true;

        return  false;
    }

    public function castToPrimitive($value)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN) ? '1' : '0';
    }
}
