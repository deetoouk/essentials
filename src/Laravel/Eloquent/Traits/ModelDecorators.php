<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Traits;

/**
 * Class ModelRelationships
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Traits
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
