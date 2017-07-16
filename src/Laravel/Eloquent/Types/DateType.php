<?php

namespace JordanDobrev\Essentials\Laravel\Eloquent\Types;

use Carbon\Carbon;
use DateTime;
use JordanDobrev\Essentials\Exceptions\Error;

/**
 * Class DateType
 *
 * @package JordanDobrev\Essentials\Laravel\Eloquent\Types
 */
class DateType extends Type
{
    function validate($attribute, $value)
    {
        if (!($value instanceof DateTime)) {
            throw new Error(':attribute must be a date time object');
        }
    }

    public function cast($value)
    {
        if ($value instanceof DateTime) {
            return $value;
        }

        return Carbon::createFromTimestamp(strtotime($value))->startOfDay();
    }

    public function toPrimitive($value)
    {
        return $value->startOfDay()->format('Y-m-d H:i:s');
    }
}
