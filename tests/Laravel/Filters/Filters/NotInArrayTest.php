<?php

namespace Tests\Laravel\Filters\Filters;

use DeeToo\Essentials\Exceptions\Error;
use DeeToo\Essentials\Laravel\Filters\Filters\NotInArray;
use DeeToo\Essentials\Laravel\Filters\Types;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class NotInArrayTest extends TestCase
{
    public function testApplyFailsWhenValueIsNotAnArray()
    {
        $this->expectException(Error::class);

        $property = 'test_property';
        $value = 'test_value';

        $mock = $this->createMock(Builder::class);

        $notInArrayFilter = new NotInArray($property);

        $notInArrayFilter->apply($mock, $value);
    }

    public function testWhereIsCalled()
    {
        $property = 'test_property';
        $value = 'test_value';

        $mock = $this->getMockBuilder(Builder::class)
            ->disableOriginalConstructor()
            ->addMethods(['whereNotIn'])
            ->getMock();

        $mock->expects($this->once())
            ->method('whereNotIn')
            ->with($property, [$value]);

        $notInArrayFilter = new NotInArray($property, 'string');

        $notInArrayFilter->apply($mock, [$value]);
    }

    public function testValueIsCasted()
    {
        $property = 'test_property';

        $mock = $this->getMockBuilder(Builder::class)
            ->disableOriginalConstructor()
            ->addMethods(['whereNotIn'])
            ->getMock();

        $mock->expects($this->once())
            ->method('whereNotIn')
            ->with($property, [12]);

        $notInArrayFilter = new NotInArray($property, Types::INT);

        $notInArrayFilter->apply($mock, ['12somestring']);
    }
}