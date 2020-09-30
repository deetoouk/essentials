<?php

namespace Tests\DeeToo\Essentials\Laravel\Eloquent\Types;

use DeeToo\Essentials\Laravel\Eloquent\Types\ArrayType;
use Tests\TestCase;

/**
 * Class ArrayTypeTest
 *
 * @package Tests\DeeToo\Essentials\Laravel\Eloquent\Types
 */
class ArrayTypeTest extends TestCase
{
    public function test_to_primitive()
    {
        $obj = new ArrayType();

        $value = ['foo' => 'bar'];

        $primitive = $obj->castToPrimitive(['foo' => 'bar']);

        $this->assertSame($primitive, json_encode($value));
    }

    public function test_cast_from_primitive()
    {
        $obj = new ArrayType();

        $value = ['foo' => 'bar'];

        $result = $obj->castFromPrimitive(json_encode($value));

        $this->assertSame($result, $value);

        $result = $obj->castFromPrimitive(json_encode($value));

        $this->assertSame($result, $value);
    }

    public function test_passes_validates()
    {
        $obj = new ArrayType();

        $obj->validate(['foo' => 'bar']);

        $this->assertTrue(true);
    }

    public function test_fails_validates()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('must be an array');

        $obj = new ArrayType();

        $obj->validate('some string');
    }
}
