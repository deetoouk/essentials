<?php namespace JordanDobrev\Essentials\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as LaravelModel;
use Illuminate\Support\Str;
use JordanDobrev\Essentials\Exceptions\Error;
use JordanDobrev\Essentials\Laravel\Eloquent\Traits\ModelDecorators;
use JordanDobrev\Essentials\Laravel\Eloquent\Traits\ModelFilters;
use JordanDobrev\Essentials\Laravel\Eloquent\Traits\ModelRelationships;
use JordanDobrev\Essentials\ValueObjects\Money;
use JordanDobrev\Essentials\ValueObjects\ValueObject;

/**
 * Class Base
 *
 * @package JordanDobrev\Essentials\Model
 */
abstract class Model extends LaravelModel
{
    use ModelRelationships,
        ModelFilters,
        ModelDecorators;

    /**
     * @var bool
     */
    public $validates = true;

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

        foreach ($this->getTypes() as $parameter => $type) {
            if (!in_array($parameter, $this->guarded)) {
                $this->fillable[] = $parameter;
            }

            if (in_array($type, ['date', 'datetime']) && !in_array($parameter, $this->getDates())) {
                $this->dates[] = $parameter;
            }

            $this->casts[$parameter] = $this->getTypeCastType($type);
        }

        $this->guarded = null;

        parent::__construct($attributes);

        $this->fireModelEvent('constructed', false);
    }

    /**
     * @param $type
     *
     * @return string
     */
    public function getTypeCastType($type)
    {
        if (is_subclass_of($type, ValueObject::class)) {
            return $type;
        }

        if (is_subclass_of($type, Model::class) || $type === Model::class) {
            return $type;
        }

        switch ($type) {
            case 'id':
            case 'unsignedInteger':
            case 'integer':
            case 'percentage':
            case 'microtime':
                return 'integer';
            case 'uuid':
            case 'identifier':
            case 'language':
            case 'country':
            case 'email':
            case 'enumerable':
            case 'text':
            case 'url':
                return 'string';
            default:
                return $type;
        }
    }

    /**
     * @param     $callback
     * @param int $priority
     */
    public static function buzzUpdated($callback, $priority = 0)
    {
        static::registerModelEvent('buzzUpdated', $callback, $priority);
    }

    /**
     * Listen for save event
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (!$model->validates) {
                return;
            }

            $model->validate();
        });
    }

    /**
     * @param $field
     *
     * @return bool
     */
    public function isNullable(string $field): bool
    {
        return in_array($field, $this->nullable);
    }

    /**
     * @param $field
     *
     * @return bool
     */
    public function hasType($field): bool
    {
        return isset($this->types[$field]);
    }

    /**
     * @param $field
     *
     * @return mixed|null
     */
    public function getType($field)
    {
        return $this->types[$field] ?? null;
    }

    /**
     * @param $field
     * @param $value
     *
     * @return bool
     */
    public function isType($field, $value)
    {
        if (!$this->hasType($field)) {
            return false;
        }

        return $this->getType($field) === $value;
    }

    /**
     * @return array
     */
    public function getAppends()
    {
        return $this->appends;
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string $key
     * @param  mixed  $value
     *
     * @return void
     */
    public function setAttribute($key, $value)
    {
        if (is_scalar($value)) {
            if (is_string($value)) {
                $value = trim($value);
            }

            if ($value === '') {
                $value = null;
            }
        }

        if (in_array($key, $this->getDates())) {
            if (is_string($value)) {
                $value = Carbon::createFromTimestamp(strtotime($value));
            }
        }

        if (!is_null($value)) {
            $cast = $this->getCasts()[$key] ?? null;

            if (is_subclass_of($cast, ValueObject::class)) {
                if (!($value instanceof ValueObject)) {
                    if ($cast === Money::class) {
                        $value = (new $cast($value, $this->currency))->toPrimitive();
                    } else {
                        $value = (new $cast($value))->toPrimitive();
                    }
                } else {
                    $value = $value->toPrimitive();
                }

                assert(is_scalar($value), 'Value object primitive value is not a scalar value!');
            }
        }

        parent::setAttribute($key, $value);
    }

    /**
     * @param        $query
     * @param        $field
     * @param string $direction
     *
     * @return mixed
     * @throws Error
     */
    public function scopeOrder($query, $field, $direction = 'asc')
    {
        if ($field !== $this->getKeyName() && !isset($this->casts[$field]) && !in_array($field, $this->getDates())) {
            throw new Error('Cannot order by :field', compact('field'));
        }

        if ($direction != 'asc') {
            $direction = 'desc';
        }

        return $query->orderBy($field, $direction);
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed
     */
    public function castAttribute($key, $value)
    {
        if (!is_null($value)) {
            $cast = $this->getCasts()[$key] ?? null;

            if (is_subclass_of($cast, ValueObject::class)) {
                if ($value instanceof ValueObject) {
                    return $value;
                }

                if ($cast === Money::class) {
                    return (new $cast($value, $this->currency));
                }

                return (new $cast($value));
            }
        }

        return parent::castAttribute($key, $value);
    }

    /**
     * @return $this
     */
    public function validate()
    {
        if ($this->types) {//validate casts
            $rules       = [];
            $customRules = $this->getRules();

            $types = array_except($this->types, ['id']);

            foreach ($types as $field => $type) {
                if (is_subclass_of($type, ValueObject::class)) {
                    if (in_array($field, $this->nullable)) {
                        $rules[$field] = 'nullable';
                    } elseif (isset($this->defaults[$field])) {
                        $rules[$field] = 'sometimes|required';
                    } else {
                        $rules[$field] = 'required';
                    }

                    if (!empty($customRules[$field])) {
                        $rules[$field] .= '|' . $customRules[$field];
                        unset($customRules[$field]);
                    }

                    continue;
                }

                if (is_subclass_of($type, Model::class) || $type === Model::class) {
                    if (in_array($field, $this->nullable)) {
                        $rules[$field] = 'nullable';
                    } elseif (isset($this->defaults[$field])) {
                        $rules[$field] = 'sometimes|required';
                    } else {
                        $rules[$field] = 'required';
                    }

                    if (!empty($customRules[$field])) {
                        $rules[$field] .= '|' . $customRules[$field];
                        unset($customRules[$field]);
                    }

                    continue;
                }

                if ($type == 'int') {
                    $cast_rule = 'integer';
                } elseif ($type == 'unsignedInteger') {
                    $cast_rule = 'integer|min:0';
                } elseif ($type == 'microtime') {
                    $cast_rule = 'integer|min:0';
                } elseif ($type == 'uuid') {
                    $cast_rule = 'string|utf8_string|size:36';
                } elseif ($type == 'id') {
                    $cast_rule = 'integer|min:1';
                } elseif ($type == 'datetime') {
                    $cast_rule = 'date';
                } elseif ($type == 'string') {
                    $cast_rule = 'string|utf8_string|max:255';
                } elseif ($type == 'text') {
                    $cast_rule = 'string|utf8_string';
                } elseif ($type == 'enumerable') {
                    $cast_rule = 'string|utf8_string';
                } elseif ($type == 'boolean') {
                    $cast_rule = 'boolean';
                } else {
                    $cast_rule = $type;
                }

                if (in_array($field, $this->nullable)) {
                    $rules[$field] = 'nullable|' . $cast_rule;
                } elseif (isset($this->defaults[$field])) {
                    $rules[$field] = 'sometimes|required|' . $cast_rule;
                } else {
                    $rules[$field] = 'required|' . $cast_rule;
                }

                if (isset($this->enumerable[$field])) {
                    $rules[$field] .= '|in:' . implode(',', $this->enumerable[$field]);
                }

                if (in_array($field, ['created_at', 'updated_at'])) {
                    $rules[$field] .= '|sometimes';
                }

                if (!empty($customRules[$field])) {
                    $rules[$field] .= '|' . $customRules[$field];
                    unset($customRules[$field]);
                }
            }

            $rules = array_merge($rules, $customRules);

            $attributes = $this->attributesToArray();
            //add hidden because attributes to array skips them
            foreach ($this->hidden as $hidden) {
                $attributes[$hidden] = $this->{$hidden};
            }

            validate($attributes, $rules);

            //validate fk
            foreach ($this->types as $field => $type) {
                //only validate dirty data!
                if (!$this->isDirty($field)) {
                    continue;
                }

                if (!$this->{$field}) {
                    continue;
                }

                if (!is_subclass_of($type, Model::class) && $type !== Model::class) {
                    continue;
                }

                $relation = camel_case(Str::replaceLast('_id', '', $field));

                $exists = $this->{$relation}()->exists();

                if (!$exists) {
                    throw new Error(
                        ":model relation ':relation' not found for id '#:id'!",
                        [
                            'model'    => class_basename($this),
                            'relation' => $relation,
                            'id'       => $this->{$field},
                        ]
                    );
                }
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return [];
    }

    /**
     * @return array
     */
    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();

        foreach ($attributes as $key => $value) {
            if ($value instanceof ValueObject) {
                $attributes[$key] = $value->value;
                foreach ($value->serialize as $name) {
                    $attributes[$key . '_' . $name] = $value->{$name};
                }
            }
        }

        return $attributes;
    }

    /**
     * @param array $options
     *
     * @return bool
     */
    public function save(array $options = [])
    {
        foreach ($this->type as $field => $type) {
            if (!$type->has_default) {
                continue;
            }

            if (array_key_exists($field, $this->attributes)) {
                continue;
            }

            $this->attributes[$field] = $type->default;
        }

        return parent::save($options);
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
