<?php namespace JTDSoft\Essentials\Laravel\Eloquent\Traits;

use DateTime;
use Illuminate\Support\Str;
use JTDSoft\Essentials\Exceptions\Error;
use JTDSoft\Essentials\Exceptions\Errors;
use JTDSoft\Essentials\Exceptions\Fatal;
use JTDSoft\Essentials\Laravel\Eloquent\Types\DateTimeType;
use JTDSoft\Essentials\Laravel\Eloquent\Types\IntegerType;
use JTDSoft\Essentials\Laravel\Eloquent\Types\RelationType;
use JTDSoft\Essentials\ValueObjects\ValueObject;
use stdClass;
use Throwable;

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
    protected $errors = [];

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
     * @return array|null
     */
    abstract protected function types(): ?array;

    /**
     *
     */
    public function initModelTypes()
    {
        $defaultTypes = [
            'id' => (new IntegerType())->unsigned(true),
        ];

        if ($this->timestamps) {
            $defaultTypes['updated_at'] = new DateTimeType();
            $defaultTypes['created_at'] = new DateTimeType();
        }

        $this->types = array_merge($defaultTypes, $this->types(), $this->types);

        foreach ($this->types as $attribute => $type) {
            if (!in_array($attribute, $this->guarded)) {
                $this->fillable[] = $attribute;
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
     * @throws Errors
     */
    public function validate()
    {
        $types = array_except($this->types, ['id']);

        foreach ($types as $key => $type) {
            if ($this->hasError($key)) {
                continue;
            }

            $value = $this->attributes[$key] ?? null;

            if (is_null($value)) {
                if (!$type->nullable && !$type->has_default) {
                    $this->recordError($key, __(':key is required', compact('key')));
                }

                continue;
            }

            if ($type instanceof RelationType) {
                $relation = camel_case(Str::replaceLast('_id', '', $key));

                $exists = $this->$relation()->exists();

                if (!$exists) {
                    $this->recordError($key, __(':key relation #:value does not exist', compact('key', 'value')));
                }
            }
        }

        if ($this->hasErrors()) {
            throw new Errors($this->getErrors());
        }

        return $this;
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    public function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return $value;
        }

        $type = $this->types[$key] ?? null;

        return $type->castFromPrimitive($value);
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string $key
     * @param  mixed $value
     *
     * @return self
     */
    public function setAttribute($key, $value)
    {
        $this->clearError($key);

        if (is_scalar($value)) {
            if (is_string($value)) {
                $value = trim($value);
            }

            if ($value === '') {
                $value = null;
            }
        }

        if ($this->hasSetMutator($key)) {
            $method = 'set' . Str::studly($key) . 'Attribute';

            $value = $this->{$method}($value);
        }

        if (!is_null($value)) {
            try {
                $type = $this->getType($key);

                if ($type) {
                    $type->validate($value);

                    $value = $type->castToPrimitive($value);

                    if (!is_scalar($value)) {
                        throw new Fatal('Primitive value is not a scalar value!');
                    }
                }
            } catch (Throwable $e) {
                $this->recordError($key, $e->getMessage());

                $value = null;
            }
        }

        $this->attributes[$key] = $value;

        return $this;
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
            if (is_null($value)) {
                $attributes[$key] = $value;

                continue;
            }

            $type = $this->getType($key);

            if ($type) {
                $value = $type->castFromPrimitive($value);
            }

            if ($value instanceof ValueObject) {
                $attributes[$key] = $value->value;
            } elseif ($value instanceof DateTime) {
                $attributes[$key] = $value->format($type->format ?? DateTime::W3C);
            } elseif (is_object($value) && get_class($value) === stdClass::class) {
                $attributes[$key] = (array)$value;
            } else {
                $attributes[$key] = $value;
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
        foreach ($this->types as $field => $type) {
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

    protected function clearError($key)
    {
        $this->errors = array_forget($this->errors, $key) ?? [];
    }

    protected function recordError($key, $message)
    {
        $this->errors[$key] = $message;
    }

    public function hasError($key)
    {
        return array_has($this->errors, $key);
    }

    public function getError($key)
    {
        return array_get($this->errors, $key);
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
