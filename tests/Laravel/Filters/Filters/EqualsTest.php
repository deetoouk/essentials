<?php

namespace Tests\Laravel\Filters\Filters;

use DeeToo\Essentials\Laravel\Filters\Filters\Equals;
use DeeToo\Essentials\Laravel\Filters\Types;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class EqualsTest extends TestCase
{
    public function testWhereIsCalled()
    {
        $property = 'test_property';
        $value = 'test_value';

        $mock = $this->createMock(Builder::class);

        $mock->expects($this->once())
            ->method('where')
            ->with($property, $value);

        $equalsFilter = new Equals($property, 'string');

        $equalsFilter->apply($mock, $value);
    }

    public function testValueIsCasted()
    {
        $property = 'test_property';

        $mock = $this->createMock(Builder::class);

        $mock->expects($this->once())
            ->method('where')
            ->with($property, 12);

        $equalsFilter = new Equals($property, Types::INT);

        $equalsFilter->apply($mock, '12somestring');
    }
}