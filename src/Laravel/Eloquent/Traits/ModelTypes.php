<?php namespace JordanDobrev\Essentials\Laravel\Eloquent\Traits;

use JordanDobrev\Essentials\Laravel\Eloquent\Types\DateTimeType;

/**
 * Class ModelTypes
 *
 * @package JordanDobrev\Essentials\Laravel\Eloquent\Traits
 */
trait ModelTypes
{
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
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = $model->generateUuid();
            }
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
     */
    public function validate()
    {
        if ($this->types) {//validate casts
            $rules       = [];
            $customRules = $this->getRules();

            $types = array_except($this->types, ['id']);

            foreach ($types as $field => $type) {
                if ($type->nullable) {
                    $rules[$field] = 'nullable';
                } elseif ($type->has_default) {
                    $rules[$field] = 'sometimes|required';
                } else {
                    $rules[$field] = 'required';
                }

                if (!empty($customRules[$field])) {
                    $rules[$field] .= '|' . $customRules[$field];
                    unset($customRules[$field]);
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
}
