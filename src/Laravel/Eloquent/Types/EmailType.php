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
    public function validate($value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            throw new Error('must be a valid email address');
        }
    }
}
