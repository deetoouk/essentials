<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Exceptions\Error;

/**
 * Class Type
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
abstract class Type
{
    /**
     * @var bool
     */
    public $nullable = false;

    /**
     * @var
     */
    public $default;

    /**
     * @var bool
     */
    public $has_default = false;

    /**
     * Specifies whether type is nullable
     *
     * @param bool $nullable
     *
     * @return $this
     * @throws Error
     */
    public function nullable(bool $nullable = true)
    {
        $this->nullable = $nullable;

        $this->default(null);

        return $this;
    }

    /**
     * Specifies default value for type
     *
     * @param mixed $default
     *
     * @return $this
     * @throws Error
     */
    public function default($default)
    {
        if (!is_null($default)) {
            $default = $this->cast($default);

            $this->validate('default value', $default);
        } else {
            if (!$this->nullable) {
                throw new Error('Default cannot be null it type is not declared as nullable!');
            }
        }

        $this->default     = $default;
        $this->has_default = true;

        return $this;
    }

    /**
     * Validates attribute with specified value
     *
     * @param $attribute
     * @param $value
     *
     * @throws Error
     * @return mixed
     */
    abstract public function validate($attribute, $value);

    /**
     * Casts value
     *
     * @param $value
     *
     * @return mixed
     */
    public function cast($value)
    {
        return $value;
    }

    /**
     * Converts value to database primitive type
     *
     * @param $value
     *
     * @return mixed
     */
    public function toPrimitive($value)
    {
        return $value;
    }
}
