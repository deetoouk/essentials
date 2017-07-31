<?php

namespace Tests\JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Laravel\Eloquent\Types\EnumerableType;
use Tests\TestCase;

/**
 * Class EnumerableTypeTest
 *
 * @package Tests\JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class EnumerableTypeTest extends TestCase
{
    public function test_passes_validates()
    {
        $obj = new EnumerableType(['one', 'two']);

        $obj->validate('foo', 'one');

        $this->assertTrue(true);
    }

    /**
     * @expectedException \JTDSoft\Essentials\Exceptions\Error
     * @expectedExceptionMessage foo has an invalid value
     */
    public function test_fails_validates()
    {
        $obj = new EnumerableType(['one', 'two']);

        $obj->validate('foo', 'some value');
    }
}
