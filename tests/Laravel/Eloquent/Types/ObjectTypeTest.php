<?php

namespace Tests\JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Laravel\Eloquent\Types\ObjectType;
use Tests\TestCase;

/**
 * Class ObjectTypeTest
 *
 * @package Tests\JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class ObjectTypeTest extends TestCase
{
    public function test_to_primitive()
    {
        $obj = new ObjectType();

        $value = (object)['foo' => 'bar'];

        $primitive = $obj->toPrimitive($value);

        $this->assertSame($primitive, json_encode($value));
    }

    public function test_cast()
    {
        $obj = new ObjectType();

        $value = ['foo' => 'bar'];

        $result = $obj->cast($value);

        $this->assertEquals($result, (object)$value);

        $result = $obj->cast(json_encode($value));

        $this->assertEquals($result, (object)$value);
    }

    public function test_passes_validates()
    {
        $obj = new ObjectType();

        $obj->validate('foo', (object)['foo' => 'bar']);

        $this->assertTrue(true);
    }

    /**
     * @expectedException \JTDSoft\Essentials\Exceptions\Error
     * @expectedExceptionMessage foo must be an object
     */
    public function test_fails_validates()
    {
        $obj = new ObjectType();

        $obj->validate('foo', 'some string');
    }
}
