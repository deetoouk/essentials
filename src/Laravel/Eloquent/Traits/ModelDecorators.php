<?php

namespace JordanDobrev\Essentials\Laravel\Eloquent\Traits;

/**
 * Class ModelRelationships
 *
 * @package JordanDobrev\Essentials\Laravel\Eloquent\Traits
 */
trait ModelDecorators
{
    /**
     * @var bool
     */
    public $decorated = false;

    /**
     * @var array
     */
    public $decorated_attributes = [];

    /**
     * @param $key
     *
     * @return bool
     */
    public function hasDecoratedAttribute($key)
    {
        return isset($this->decorated_attributes[$key]);
    }

    /**
     * @param $key
     *
     * @return mixed|null
     */
    public function getDecoratedAttribute($key)
    {
        return $this->decorated_attributes[$key] ?? null;
    }

    /**
     * Get an attribute from the model.
     *
     * @param  string $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        if ($this->hasDecoratedAttribute($key)) {
            return $this->getDecoratedAttribute($key);
        }

        return parent::getAttribute($key);
    }

    /**
     * @param $key
     * @param $value
     */
    public function setDecoratedAttribute($key, $value)
    {
        $this->decorated_attributes[$key] = $value;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), $this->decorated_attributes);
    }
}
