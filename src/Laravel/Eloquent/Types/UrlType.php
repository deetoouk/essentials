<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Exceptions\Error;

/**
 * Class UrlType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class UrlType extends Type
{
    function validate($attribute, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new Error(':attribute must be a valid url');
        }
    }
}
