<?php

namespace Tests\JordanDobrev\Essentials\Laravel\Eloquent\Types;

use JordanDobrev\Essentials\Laravel\Eloquent\Types\ArrayType;
use Tests\TestCase;

/**
 * Class ArrayTypeTest
 *
 * @package Tests\JordanDobrev\Essentials\Laravel\Eloquent\Types
 */
class ArrayTypeTest extends TestCase
{
    public function test_to_primitive()
    {
        $obj = new ArrayType();

        $value = ['foo' => 'bar'];

        $primitive = $obj->toPrimitive(['foo' => 'bar']);

        $this->assertSame($primitive, json_encode($value));
    }

    public function test_cast()
    {
        $obj = new ArrayType();

        $value = ['foo' => 'bar'];

        $result = $obj->cast($value);

        $this->assertSame($result, $value);

        $result = $obj->cast(json_encode($value));

        $this->assertSame($result, $value);
    }

    public function test_passes_validates()
    {
        $obj = new ArrayType();

        $obj->validate('foo', ['foo' => 'bar']);

        $this->assertTrue(true);
    }

    /**
     * @expectedException \JordanDobrev\Essentials\Exceptions\Error
     * @expectedExceptionMessage foo must be an array
     */
    public function test_fails_validates()
    {
        $obj = new ArrayType();

        $obj->validate('foo', 'some string');
    }
}
