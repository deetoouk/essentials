<?php

namespace Tests\DeeToo\Essentials\Laravel\Eloquent\Types;

use DeeToo\Essentials\Laravel\Eloquent\Types\ObjectType;
use Tests\TestCase;

/**
 * Class ObjectTypeTest
 *
 * @package Tests\DeeToo\Essentials\Laravel\Eloquent\Types
 */
class ObjectTypeTest extends TestCase
{
    public function test_to_primitive()
    {
        $obj = new ObjectType();

        $value = (object)['foo' => 'bar'];

        $primitive = $obj->castToPrimitive($value);

        $this->assertSame($primitive, json_encode($value));
    }

    public function test_cast_from_primitive()
    {
        $obj = new ObjectType();

        $value = ['foo' => 'bar'];

        $result = $obj->castFromPrimitive(json_encode($value));

        $this->assertEquals($result, (object)$value);

        $result = $obj->castFromPrimitive(json_encode($value));

        $this->assertEquals($result, (object)$value);
    }

    public function test_passes_validates()
    {
        $obj = new ObjectType();

        $obj->validate((object)['foo' => 'bar']);

        $this->assertTrue(true);
    }

    public function test_fails_validates()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('must be an object');

        $obj = new ObjectType();

        $obj->validate('some string');
    }
}
