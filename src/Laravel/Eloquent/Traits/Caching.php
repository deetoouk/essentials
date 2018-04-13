<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class HasAddress
 *
 * @package LiveBuzz\Model\Traits
 */
trait Caching
{
    /**
     * @var string
     */
    protected static $cache_prefix = '';

    /** @var int cache time */
    protected $cache_time = 15;

    /**
     * Boots the trait
     */
    public static function bootCaching()
    {
        static::saved(function ($model) {
            static::flushCached();
        });

        static::deleted(function ($model) {
            static::flushCached();
        });
    }

    public static function flushCached()
    {
        cache()->forget(static::getCacheKey());
    }

    protected static function getCacheKey()
    {
        $class = new \ReflectionClass(new static());

        return self::$cache_prefix . $class->getShortName();
    }

    public static function find($id)
    {
        if (is_array($id)) {
            return static::getAllCachedById()->only($id);
        }

        return array_get(static::getAllCachedById(), $id);
    }

    public static function getAllCachedById()
    {
        //60 minutes remember time
        return cache()->remember(static::getCacheKey(), (new static)->cache_time, function () {
            return (new static())->withoutGlobalScopes()->get()->keyBy('id');
        });
    }

    public static function retrieveOrFail($search)
    {
        $model = static::retrieve($search);

        if (!$model) {
            throw new ModelNotFoundException('Model ' . class_basename(new self) . ' for ' . $search . ' not found!');
        }

        return $model;
    }

    public static function retrieve($search)
    {
        $search = strtolower($search);

        $models = static::getAllCachedById();

        if (isset($models[$search])) {
            return $models[$search];
        }

        return $models->where('identifier', $search)->first();
    }
}
