<?php

namespace Tests\Illuminate\Database\Eloquent;

use JTDSoft\Essentials\Laravel\Eloquent\Types\ArrayType;
use JTDSoft\Essentials\Laravel\Eloquent\Types\BooleanType;
use JTDSoft\Essentials\Laravel\Eloquent\Types\DateTimeType;
use JTDSoft\Essentials\Laravel\Eloquent\Types\DateType;
use JTDSoft\Essentials\Laravel\Eloquent\Types\EmailType;
use JTDSoft\Essentials\Laravel\Eloquent\Types\EnumerableType;
use JTDSoft\Essentials\Laravel\Eloquent\Types\FloatType;
use JTDSoft\Essentials\Laravel\Eloquent\Types\IntegerType;
use JTDSoft\Essentials\Laravel\Eloquent\Types\ObjectType;
use JTDSoft\Essentials\Laravel\Eloquent\Types\RelationType;
use JTDSoft\Essentials\Laravel\Eloquent\Types\StringType;
use JTDSoft\Essentials\Laravel\Eloquent\Types\TextType;
use JTDSoft\Essentials\Laravel\Eloquent\Types\UrlType;
use JTDSoft\Essentials\Laravel\Eloquent\Types\ValueObjectType;
use JTDSoft\Essentials\Laravel\Eloquent\Model;
use JTDSoft\Essentials\ValueObjects\Currency;

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
