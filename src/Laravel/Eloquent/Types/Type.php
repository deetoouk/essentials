<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Exceptions\Error;
use Throwable;

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
            try {
                $this->validate($default);
            } catch (Throwable $e) {
                throw new Error('default value :error', ['error' => $e->getMessage()]);
            }

            $default = $this->castFromPrimitive($default);
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
     * @param $value
     *
     * @throws Error
     * @return mixed
     */
    abstract public function validate($value);

    /**
     * Casts value
     *
     * @param $value
     *
     * @return mixed
     */
    public function castFromPrimitive($value)
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
    public function castToPrimitive($value)
    {
        return $value;
    }
}
