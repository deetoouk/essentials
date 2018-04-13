<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Types;

use DeeToo\Essentials\Exceptions\Error;

/**
 * Class UrlType
 *
 * @package DeeToo\Essentials\Laravel\Eloquent\Types
 */
class UrlType extends StringType
{
    public function validate($value)
    {
        if (filter_var($value, FILTER_VALIDATE_URL) === false) {
            throw new Error('must be a valid url');
        }
    }
}
