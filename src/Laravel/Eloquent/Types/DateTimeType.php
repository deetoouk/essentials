<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use Carbon\Carbon;
use DateTime;
use JTDSoft\Essentials\Exceptions\Error;

/**
 * Class DateTimeType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class DateTimeType extends Type
{
    public static $format = 'Y-m-d H:i:s';

    public function validate($attribute, $value)
    {
        if (!($value instanceof DateTime)) {
            throw new Error(':attribute must be a date time object', compact('attribute'));
        }
    }

    public function cast($value)
    {
        if ($value instanceof DateTime) {
            return Carbon::instance($value);
        }

        return Carbon::createFromTimestamp(strtotime($value));
    }

    public function toPrimitive($value)
    {
        return $value->format(self::$format);
    }
}
