<?php

namespace Tests\Illuminate\Database\Eloquent;

use JordanDobrev\Essentials\Laravel\Eloquent\Types\ArrayType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\BooleanType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\DateTimeType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\DateType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\EmailType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\EnumerableType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\FloatType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\IntegerType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\ObjectType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\RelationType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\StringType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\TextType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\UrlType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\ValueObjectType;
use JordanDobrev\Essentials\Model\Model;
use JordanDobrev\Essentials\ValueObjects\Currency;

class TestModel extends Model
{
    public function types()
    {
        return [
            'integer'    => new IntegerType(),
            'float'      => new FloatType(),
            'string'     => new StringType(),
            'boolean'    => new BooleanType(),
            'datetime'   => new DateTimeType(),
            'date'       => new DateType(),
            'email'      => new EmailType(),
            'enumerable' => new EnumerableType(['one', 'two']),
            'array'      => new ArrayType(),
            'object'     => new ObjectType(),
            'relation'   => new RelationType(self::class),
            'text'       => new TextType(),
            'url'        => new UrlType(),
            'vo'         => new ValueObjectType(Currency::class),
        ];
    }
}
