<?php

namespace DeeToo\Essentials\ValueObjects;

use JsonSerializable;
use DeeToo\Essentials\Exceptions\Fatal;
use Illuminate\Support\Str;

abstract class ValueObject implements JsonSerializable
{
    protected $value;

    public array $serialize = [];

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __get($key)
    {
        $key = Str::camel($key);

        if (method_exists($this, $key)) {
            return $this->{$key}();
        }

        throw new Fatal('Method :key does not exist for :class', ['key' => $key, 'class' => get_class($this)]);
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function value()
    {
        return $this->value;
    }

    public function castToPrimitive()
    {
        return $this->value;
    }

    public function isEmpty(): bool
    {
        return empty($this->value);
    }

    public function isEqualTo($value): bool
    {
        if ($value instanceof static) {
            $value = $value->value;
        }

        return $this->value === $value;
    }

    public function isNotEqualTo($value): bool
    {
        if ($value instanceof static) {
            $value = $value->value;
        }

        return $this->value !== $value;
    }

    public function toArray(): array
    {
        $serialized = [];

        $serialized['value'] = $this->value;

        foreach ($this->serialize as $name) {
            $serialized[$name] = $this->{$name};
        }

        return $serialized;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
