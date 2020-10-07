# Essentials

[![Build Status](https://travis-ci.org/deetoouk/essentials.svg?branch=master)](https://travis-ci.org/jtdsoft/essentials)

DeeToo Essentials provides tools that enhances your Laravel experience.

The DeeToo Model provides an extra layer of validation to protect you against yourself. If validates the data before you save it to the database and verifies if a relation actually exists. It also provides nice additional features like read only properties and value objects.

### Usage

```php
<?php

use DeeToo\Essentials\Laravel\Eloquent\Model;
use DeeToo\Essentials\Laravel\Eloquent\Types\ArrayType;
use DeeToo\Essentials\Laravel\Eloquent\Types\BooleanType;
use DeeToo\Essentials\Laravel\Eloquent\Types\DateTimeType;
use DeeToo\Essentials\Laravel\Eloquent\Types\DateType;
use DeeToo\Essentials\Laravel\Eloquent\Types\EmailType;
use DeeToo\Essentials\Laravel\Eloquent\Types\EnumerableType;
use DeeToo\Essentials\Laravel\Eloquent\Types\FloatType;
use DeeToo\Essentials\Laravel\Eloquent\Types\IntegerType;
use DeeToo\Essentials\Laravel\Eloquent\Types\ObjectType;
use DeeToo\Essentials\Laravel\Eloquent\Types\RelationType;
use DeeToo\Essentials\Laravel\Eloquent\Types\StringType;
use DeeToo\Essentials\Laravel\Eloquent\Types\TextType;
use DeeToo\Essentials\Laravel\Eloquent\Types\UrlType;
use DeeToo\Essentials\Laravel\Eloquent\Types\ValueObjectType;
use DeeToo\Essentials\ValueObjects\Country;
use DeeToo\Essentials\ValueObjects\Currency;
use DeeToo\Essentials\ValueObjects\Temperature;

class TestModel extends Model
{
    protected $readOnly = ['read_only'];

    public function types(): array
    {
        return [
            'integer'     => new IntegerType(),
            'float'       => new FloatType(),
            'string'      => new StringType(),
            'boolean'     => new BooleanType(),
            'datetime'    => new DateTimeType(),
            'date'        => new DateType(),
            'email'       => new EmailType(),
            'enumerable'  => new EnumerableType(['one', 'two']),
            'array'       => new ArrayType(),
            'object'      => new ObjectType(),
            'relation_id' => new RelationType(self::class),
            'text'        => new TextType(),
            'url'         => new UrlType(),
            'country'     => new ValueObjectType(Country::class),
            'vo'          => new ValueObjectType(Currency::class),
            'temp'        => new ValueObjectType(Temperature::class),
            'read_only'   => new StringType(),
        ];
    }
}

```

Each type can be set as nullable and have a default value:

```php
(new IntegerType())
    ->nullable()
    ->default(1)
```

Each different type can have his own options on top:

```php
(new IntegerType())
    ->nullable()
    ->default(1)
    ->unsigned()
    ->max(100)
```

You can extend and create new value object as well:

```php
<?php

use DeeToo\Essentials\Exceptions\Error;

class Humidity extends ValueObject
{
    public array $serialize = [
        'formatted',
    ];

    public function __construct($value)
    {
        parent::__construct(intval($value));

        if (!is_numeric($this->value)) {
            throw new Error('Invalid percentage value :value', ['value' => $this->value]);
        }

        if ($this->value > 10000) {
            throw new Error('Percentage value :value cannot be more than 10000', ['value' => $this->value]);
        }

        if ($this->value < 0) {
            throw new Error('Percentage value :value cannot be more negative', ['value' => $this->value]);
        }
    }

    public function formatted(): string
    {
        return format()->percent($this->value);
    }
}
```

Where the `serialize` array is the list of values that will be serialized when the Model is converted to Array/Json.


You can also create your own types:

```php
<?php

use DeeToo\Essentials\Exceptions\Error;

/**
 * Class EmailType
 */
class EmailType extends Type
{
    public function validate($value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            throw new Error('must be a valid email address');
        }
    }
}
```

You can add options that you can chain. All you need is to validate them accordingly in the `validate` method.
