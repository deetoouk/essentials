<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Exceptions\Error;

/**
 * Class EmailType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class EmailType extends Type
{
    function validate($attribute, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new Error(':attribute must be a valid email address');
        }
    }
}
