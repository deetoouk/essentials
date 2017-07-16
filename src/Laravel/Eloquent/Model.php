<?php

namespace JordanDobrev\Essentials\Model;

use Illuminate\Database\Eloquent\Model as LaravelModel;
use JordanDobrev\Essentials\Laravel\Eloquent\Traits\ModelDecorators;
use JordanDobrev\Essentials\Laravel\Eloquent\Traits\ModelFilters;
use JordanDobrev\Essentials\Laravel\Eloquent\Traits\ModelRelationships;
use JordanDobrev\Essentials\Laravel\Eloquent\Traits\ModelTypes;

/**
 * Class Base
 *
 * @package JordanDobrev\Essentials\Model
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
