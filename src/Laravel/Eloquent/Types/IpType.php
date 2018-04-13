<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Types;

use DeeToo\Essentials\Exceptions\Error;

/**
 * Class IpType
 *
 * @package DeeToo\Essentials\Laravel\Eloquent\Types
 */
class IpType extends Type
{
    public function validate($value)
    {
        if (filter_var($value, FILTER_VALIDATE_IP) === false) {
            throw new Error('must be a valid ip address');
        }
    }

    public function castFromPrimitive($value)
    {
        return long2ip($value);
    }

    public function castToPrimitive($value)
    {
        return ip2long($value);
    }
}
