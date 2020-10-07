<?php

namespace Tests\Laravel\Filters\Filters;

use DeeToo\Essentials\Exceptions\Error;
use DeeToo\Essentials\Laravel\Filters\Filters\InArray;
use DeeToo\Essentials\Laravel\Filters\Types;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class InArrayTest extends TestCase
{
    public function testApplyFailsWhenValueIsNotAnArray()
    {
        $this->expectException(Error::class);

        $property = 'test_property';
        $value = 'test_value';

        $mock = $this->createMock(Builder::class);

        $inArrayFilter = new InArray($property);

        $inArrayFilter->apply($mock, $value);
    }

    public function testWhereIsCalled()
    {
        $property = 'test_property';
        $value = 'test_value';

        $mock = $this->getMockBuilder(Builder::class)
            ->disableOriginalConstructor()
            ->addMethods(['whereIn'])
            ->getMock();

        $mock->expects($this->once())
            ->method('whereIn')
            ->with($property, [$value]);

        $inArrayFilter = new InArray($property, 'string');

        $inArrayFilter->apply($mock, [$value]);
    }

    public function testValueIsCasted()
    {
        $property = 'test_property';

        $mock = $this->getMockBuilder(Builder::class)
            ->disableOriginalConstructor()
            ->addMethods(['whereIn'])
            ->getMock();

        $mock->expects($this->once())
            ->method('whereIn')
            ->with($property, [12]);

        $inArrayFilter = new InArray($property, Types::INT);

        $inArrayFilter->apply($mock, ['12somestring']);
    }
}