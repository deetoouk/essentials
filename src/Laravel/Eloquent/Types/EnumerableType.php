<?php

namespace JordanDobrev\Essentials\Laravel\Eloquent\Types;

/**
 * Class EnumerableType
 *
 * @package JordanDobrev\Essentials\Laravel\Eloquent\Types
 */
class EnumerableType extends Type
{
    /**
     * @var array
     */
    public $values;

    /**
     * EnumerableType constructor.
     *
     * @param array|null $values
     */
    public function __construct(array $values = null)
    {
        if ($values) {
            $this->values($values);
        }
    }

    /**
     * @param array $values
     *
     * @return $this
     */
    public function values(array $values)
    {
        $this->values = $values;

        return $this;
    }
}
