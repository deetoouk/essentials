<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Types;

use DeeToo\Essentials\Exceptions\Error;

/**
 * Class UuidType
 *
 * @package DeeToo\Essentials\Laravel\Eloquent\Types
 */
class UuidType extends StringType
{
    public static $pattern = '[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}';

    public function validate($value)
    {
        if (!preg_match('/^' . self::$pattern . '$/i', $value)) {
            throw new Error('must be a valid uuid');
        }
    }
}
