<?php

namespace JTDSoft\Essentials\Laravel\Eloquent;

use Illuminate\Database\Eloquent\Model as LaravelModel;
use JTDSoft\Essentials\Laravel\Eloquent\Traits\ModelDecorators;
use JTDSoft\Essentials\Laravel\Eloquent\Traits\ModelFilters;
use JTDSoft\Essentials\Laravel\Eloquent\Traits\ModelRelationships;
use JTDSoft\Essentials\Laravel\Eloquent\Traits\ModelTypes;
use JTDSoft\Essentials\Laravel\Eloquent\Types\ValueObjectType;

/**
 * Class Base
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent
 */
abstract class Model extends LaravelModel
{
    use ModelTypes,
        ModelRelationships,
        ModelFilters,
        ModelDecorators;

    /**
     * Base constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fireModelEvent('constructing', false);

        foreach (class_uses_deep($this) as $trait) {
            $initMethod = 'init' . class_basename($trait);

            if (method_exists($this, $initMethod)) {
                $this->{$initMethod}();
            }
        }

        parent::__construct($attributes);

        $this->fireModelEvent('constructed', false);
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
        if (isset($this->decorated)) {
            if ($this->hasDecoratedAttribute($key)) {
                return $this->getDecoratedAttribute($key);
            }
        }

        if (method_exists($this, 'getType')) {
            if ($this->getType($key) instanceof ValueObjectType) {
                return $this->getType($key)->cast($this->attributes[$key] ?? null);
            }
        }

        return parent::getAttribute($key);
    }

    /**
     * @param $key
     * @param $value
     */
    public function setRawAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * Create a new LiveBuzz Eloquent Collection instance.
     *
     * @param  array $models
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new Collection($models);
    }

    /**
     * Register a creating model event with the dispatcher.
     *
     * @param  \Closure|string $callback
     *
     * @return void
     */
    public static function constructing($callback)
    {
        static::registerModelEvent('constructing', $callback);
    }

    /**
     * Register a created model event with the dispatcher.
     *
     * @param  \Closure|string $callback
     *
     * @return void
     */
    public static function constructed($callback)
    {
        static::registerModelEvent('constructed', $callback);
    }
}
