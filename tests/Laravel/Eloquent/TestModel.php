<?php

namespace Tests\Illuminate\Database\Eloquent;

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
            'vo'          => new ValueObjectType(Currency::class),
            'temp'        => new ValueObjectType(Temperature::class),
            'read_only'   => new StringType(),
        ];
    }
}
