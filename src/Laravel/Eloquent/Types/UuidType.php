<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Exceptions\Error;

/**
 * Class UuidType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class UuidType extends Type
{
    public static $pattern = '[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}';

    public function validate($attribute, $value)
    {
        if (!preg_match('/^' . self::$pattern . '$/i', $value)) {
            throw new Error(':attribute must be a valid uuid', compact('attribute'));
        }
    }
}
