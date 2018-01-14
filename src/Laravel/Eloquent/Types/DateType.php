<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use Carbon\Carbon;
use DateTime;
use JTDSoft\Essentials\Exceptions\Error;
use Throwable;

/**
 * Class DateType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class DateType extends Type
{
    public static $format = 'Y-m-d';

    public function validate($value)
    {
        if (!($value instanceof DateTime)) {
            try {
                Carbon::createFromFormat(self::$format, $value);
            } catch (Throwable $e) {
                throw new Error('must be a date');
            }
        }
    }

    public function castFromPrimitive($value)
    {
        return Carbon::createFromFormat(self::$format, $value)->startOfDay();
    }

    public function castToPrimitive($value)
    {
        if ($value instanceof DateTime) {
            return $value->format(self::$format);
        }

        return $value;
    }
}
