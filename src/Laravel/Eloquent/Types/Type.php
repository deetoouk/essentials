<?php

namespace JordanDobrev\Essentials\Laravel\Eloquent\Types;

/**
 * Class Type
 *
 * @package JordanDobrev\Essentials\Laravel\Eloquent\Types
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
     * @param bool $nullable
     *
     * @return $this
     */
    public function nullable(boolean $nullable = true)
    {
        $this->nullable = $nullable;

        $this->default(null);

        return $this;
    }

    /**
     * @param mixed $default
     *
     * @return $this
     */
    public function default(mixed $default)
    {
        $this->default     = $default;
        $this->has_default = true;

        return $this;
    }
}
