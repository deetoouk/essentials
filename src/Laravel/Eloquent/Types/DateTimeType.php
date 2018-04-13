<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Types;

use Carbon\Carbon;
use DateTime;
use DeeToo\Essentials\Exceptions\Error;
use Throwable;

/**
 * Class DateTimeType
 *
 * @package DeeToo\Essentials\Laravel\Eloquent\Types
 */
class DateTimeType extends Type
{
    public static $format = 'Y-m-d H:i:s';

    public function validate($value)
    {
        if (!($value instanceof DateTime)) {
            try {
                Carbon::createFromFormat(self::$format, $value);
            } catch (Throwable $e) {
                throw new Error('must be a date time');
            }
        }
    }

    public function castFromPrimitive($value)
    {
        return Carbon::createFromFormat(self::$format, $value);
    }

    public function castToPrimitive($value)
    {
        if ($value instanceof DateTime) {
            return $value->format(self::$format);
        }

        return $value;
    }
}
