<?php

namespace JordanDobrev\Essentials\Laravel\Eloquent\Types;

use JordanDobrev\Essentials\Exceptions\Fatal;
use JordanDobrev\Essentials\ValueObjects\ValueObject;

/**
 * Class ValueObjectType
 *
 * @package JordanDobrev\Essentials\Laravel\Eloquent\Types
 */
class ValueObjectType extends Type
{
    public $valueObject;

    /**
     * ValueObjectType constructor.
     *
     * @param string|null $valueObject
     */
    public function __construct(string $valueObject = null)
    {
        if ($valueObject) {
            $this->valueObject($valueObject);
        }
    }

    public function valueObject(string $valueObject)
    {
        if (!($valueObject instanceof ValueObject)) {
            throw new Fatal('ValueObject value should be an instance of ValueObject!');
        }

        $this->valueObject = $valueObject;
    }
}
