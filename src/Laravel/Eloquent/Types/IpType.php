<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Exceptions\Error;

/**
 * Class IpType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class IpType extends Type
{
    public function validate($attribute, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_IP)) {
            throw new Error(':attribute must be a valid ip address', compact('attribute'));
        }
    }

    public function cast($value)
    {
        if (is_string($value)) {
            return $value;
        }

        return long2ip($value);
    }

    public function toPrimitive($value)
    {
        return ip2long($value);
    }
}
