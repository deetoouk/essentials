<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Exceptions\Error;
use JTDSoft\Essentials\Exceptions\Fatal;
use JTDSoft\Essentials\ValueObjects\ValueObject;

/**
 * Class ValueObjectType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class ValueObjectType extends Type
{
    public $valueObject;

    /**
     * ValueObjectType constructor.
     *
     * @param string|null $valueObject
     *
     * @throws Fatal
     */
    public function __construct(string $valueObject = null)
    {
        if ($valueObject) {
            $this->valueObject($valueObject);
        }
    }

    public function valueObject(string $valueObject)
    {
        if (!is_subclass_of($valueObject, ValueObject::class)) {
            throw new Fatal('ValueObject value should be an instance of ValueObject!');
        }

        $this->valueObject = $valueObject;
    }

    public function validate($attribute, $value)
    {
        if (!($value instanceof $this->valueObject)) {
            throw new Error(':attribute must be an instance of ' . $this->valueObject);
        }
    }

    public function cast($value)
    {
        $object = $this->valueObject;

        if ($value instanceof $object) {
            return $value;
        }

        return new $object($value);
    }

    public function toPrimitive($value)
    {
        return $value->toPrimitive();
    }
}
