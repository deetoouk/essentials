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
    public function validate($attribute, $value)
    {
        if ($this->isBool($value) === false) {
            throw new Error(':attribute must be boolean', compact('attribute'));
        }
    }

    public function cast($value)
    {
        if ($this->isBool($value) === false) {
            return $value;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    public function toPrimitive($value)
    {
        return $value ? 1 : 0;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function isBool($value)
    {
        return is_bool($value) || $value === 1 || $value === 0;
    }
}
