<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use Carbon\Carbon;
use DateTime;
use JTDSoft\Essentials\Exceptions\Error;

/**
 * Class DateType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class DateType extends Type
{
    public static $format = 'Y-m-d 00:00:00';

    function validate($attribute, $value)
    {
        if (!($value instanceof DateTime)) {
            throw new Error(':attribute must be a date time object', compact('attribute'));
        }
    }

    public function cast($value)
    {
        if ($value instanceof DateTime) {
            return Carbon::instance($value)->startOfDay();
        }

        return Carbon::createFromTimestamp(strtotime($value))->startOfDay();
    }

    public function toPrimitive($value)
    {
        return $value->format(self::$format);
    }
}
