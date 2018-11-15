<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Types;

use DeeToo\Essentials\Exceptions\Error;
use DeeToo\Essentials\Exceptions\Fatal;
use DeeToo\Essentials\ValueObjects\ValueObject;
use Throwable;

/**
 * Class ValueObjectType
 *
 * @package DeeToo\Essentials\Laravel\Eloquent\Types
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
            throw new Fatal('ValueObject value should be subclass of ValueObject!');
        }

        $this->valueObject = $valueObject;
    }

    public function validate($value)
    {
        if ($value instanceof $this->valueObject) {
            return; //all fine here
        }

        try {
            $valueObject = $this->valueObject;

            new $valueObject($value);
        } catch (Throwable $e) {
            throw new Error('is invalid!');
        }
    }

    public function castFromPrimitive($primitive)
    {
        return new $this->valueObject($primitive);
    }

    public function castToPrimitive($value)
    {
        if (!$value instanceof $this->valueObject) {
            $valueObject = $this->valueObject;

            $value = (new $valueObject($value));
        }

        return $value->castToPrimitive();
    }
}
