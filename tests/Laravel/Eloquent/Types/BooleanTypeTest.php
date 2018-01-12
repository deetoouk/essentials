<?php

namespace Tests\JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Laravel\Eloquent\Types\BooleanType;
use Tests\TestCase;

/**
 * Class BooleanTypeTest
 *
 * @package Tests\JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class BooleanTypeTest extends TestCase
{
    public function test_to_primitive()
    {
        $obj = new BooleanType();

        $this->assertSame($obj->toPrimitive(true), 1);
        $this->assertSame($obj->toPrimitive(false), 0);
    }

    public function test_cast()
    {
        $obj = new BooleanType();

        $this->assertFalse($obj->cast(0));
        $this->assertFalse($obj->cast('off'));
        $this->assertFalse($obj->cast('no'));
        $this->assertFalse($obj->cast('false'));
        $this->assertFalse($obj->cast(false));
        $this->assertTrue($obj->cast(1));
        $this->assertTrue($obj->cast('on'));
        $this->assertTrue($obj->cast('yes'));
        $this->assertTrue($obj->cast('true'));
        $this->assertTrue($obj->cast(true));
    }

    public function test_passes_validates()
    {
        $obj = new BooleanType();

        $obj->validate('foo', true);

        $this->assertTrue(true);
    }

    /**
     * @expectedException \JTDSoft\Essentials\Exceptions\Error
     * @expectedExceptionMessage default value must be boolean
     */
    public function test_invalid_default_boolean()
    {
        $obj = new BooleanType();

        $obj->default('some faulty string');
    }
}
