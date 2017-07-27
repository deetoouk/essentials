<?php

namespace Tests\Illuminate\Database\Eloquent;

use JordanDobrev\Essentials\Laravel\Eloquent\Types\BooleanType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\DateTimeType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\DateType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\EmailType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\EnumerableType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\FloatType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\IntegerType;
use JordanDobrev\Essentials\Laravel\Eloquent\Types\StringType;
use JordanDobrev\Essentials\Model\Model;

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
        ];
    }
}
