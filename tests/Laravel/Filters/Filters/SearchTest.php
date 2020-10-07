<?php

namespace Tests\Laravel\Filters\Filters;

use DeeToo\Essentials\Laravel\Filters\Filters\Search;
use DeeToo\Essentials\Laravel\Filters\Types;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class SearchTest extends TestCase
{
    public function testWhereIsCalled()
    {
        $property_1 = 'test_property_1';
        $property_2 = 'test_property_2';
        $value = 'test_value';

        $mock = $this->createMock(Builder::class);

        $mock->expects($this->once())
            ->method('where')
            ->willReturn($mock);

        $searchFilter = new Search([$property_1, $property_2]);

        $searchFilter->apply($mock, $value);
    }
}