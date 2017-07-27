<?php namespace JTDSoft\Essentials\Laravel\Eloquent\Traits;

use JTDSoft\Essentials\Exceptions\Error;
use JTDSoft\Essentials\Laravel\Eloquent\Types\DateTimeType;
use JTDSoft\Essentials\Laravel\Eloquent\Types\DateType;
use JTDSoft\Essentials\ValueObjects\ValueObject;

/**
 * Class ModelTypes
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Traits
 */
trait ModelTypes
{
    /**
     * @var bool
     */
    public $validates = true;

    /**
     * @var array
     */
    protected $types = [];

    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootModelTypes()
    {
        static::saving(function ($model) {
            if (!$model->validates) {
                return;
            }

            $model->validate();
        });
    }

    /**
     *
     */
    public function initModelTypes()
    {
        $this->types = array_merge($this->types(), $this->types);

        if ($this->timestamps) {
            $types['updated_at'] = new DateTimeType();
            $types['created_at'] = new DateTimeType();
        }

        foreach ($this->types as $attribute => $type) {
            if (!in_array($attribute, $this->guarded)) {
                $this->fillable[] = $attribute;
            }

            if (($type instanceof DateTimeType || $type instanceof DateType) &&
                !in_array($attribute, $this->getDates())
            ) {
                $this->dates[] = $attribute;
            }
        }

        $this->guarded = null;
    }

    /**
     * @param bool $base_names
     *
     * @return array
     */
    public function getTypes(bool $base_names = false)
    {
        $types = $this->types;

        if ($base_names) {
            foreach ($types as &$type) {
                $type = class_basename($type);
            }
        }

        return $types;
    }

    /**
     * @return $this
     * @throws Error
     */
    public function validate()
    {
        $types = array_except($this->types, ['id']);

        foreach ($types as $attribute => $type) {
            $value = $this->attributes[$attribute] ?? null;

            if (is_null($value)) {
                if (!$type->nullable && !$type->has_default) {
                    throw new Error(':attribute is required');
                }

                continue;
            }

            if ($this->isDirty($attribute)) {
                $type->validate($attribute, $value);
            }
        }

        return $this;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed
     */
    public function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return $value;
        }

        $type = $this->types[$key] ?? null;

        return $type->cast($value);
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

        if (is_null($value)) {
            return parent::setAttribute($key, $value);
        }

        $type = $this->types[$key] ?? null;

        if (!$type) {
            return parent::setAttribute($key, $value);
        }

        if (!$this->hasSetMutator($key)) {
            $value = $type->toPrimitive($type->cast($value));

            assert(is_scalar($value), 'Primitive value is not a scalar value!');
        }

        return parent::setAttribute($key, $value);
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
     * @param        $query
     * @param        $field
     * @param string $direction
     *
     * @return mixed
     * @throws Error
     */
    public function scopeOrder($query, $field, $direction = 'asc')
    {
        if (!array_key_exists($field, $this->types)) {
            throw new Error('Cannot order by :field', compact('field'));
        }

        if ($direction != 'asc') {
            $direction = 'desc';
        }

        return $query->orderBy($field, $direction);
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
}
