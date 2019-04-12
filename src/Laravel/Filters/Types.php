<?php

namespace DeeToo\Essentials\Laravel\Filters;

/**
 * Class Types
 *
 * @package DeeToo\Essentials\Laravel\Filters
 */
class Types
{
    public const STRING = 'string';

    public const ARRAY  = 'array';

    public const OBJECT = 'object';

    public const INT    = 'int';

    public const FLOAT  = 'float';

    public const BOOL   = 'bool';

    public static function cast(string $value, string $type)
    {
        switch ($type) {
            case self::OBJECT:
                return (object)$value;
            case self::ARRAY:
                return (array)$value;
            case self::FLOAT:
                return floatval($value);
            case self::BOOL:
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            case self::INT:
                return intval($value);
            case self::STRING:
            default:
                return strval($value);
        }
    }
}
