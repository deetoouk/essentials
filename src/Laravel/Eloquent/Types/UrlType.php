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
    public function validate($attribute, $value)
    {
        if (filter_var($value, FILTER_VALIDATE_URL) === false) {
            throw new Error(':attribute must be a valid url', compact('attribute'));
        }
    }
}
