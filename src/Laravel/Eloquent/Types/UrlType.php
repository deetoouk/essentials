<?php

namespace JordanDobrev\Essentials\Laravel\Eloquent\Types;

use JordanDobrev\Essentials\Exceptions\Error;

/**
 * Class UrlType
 *
 * @package JordanDobrev\Essentials\Laravel\Eloquent\Types
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
