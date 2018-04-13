<?php

namespace Tests\DeeToo\Essentials\Laravel\Eloquent\Types;

use DeeToo\Essentials\Laravel\Eloquent\Types\BooleanType;
use Tests\TestCase;

/**
 * Class BooleanTypeTest
 *
 * @package Tests\DeeToo\Essentials\Laravel\Eloquent\Types
 */
class BooleanTypeTest extends TestCase
{
    public function test_to_primitive()
    {
        $obj = new BooleanType();

        $this->assertSame($obj->castToPrimitive(true), '1');
        $this->assertSame($obj->castToPrimitive(false), '0');
    }

    public function test_cast_from_primitive()
    {
        $obj = new BooleanType();

        $this->assertTrue($obj->castFromPrimitive('1'));
        $this->assertFalse($obj->castFromPrimitive('0'));
    }

    public function test_passes_validates()
    {
        $obj = new BooleanType();

        $obj->validate(true);

        $this->assertTrue(true);
    }

    /**
     * @expectedException \DeeToo\Essentials\Exceptions\Error
     * @expectedExceptionMessage default value must be boolean
     */
    public function test_invalid_default_boolean()
    {
        $obj = new BooleanType();

        $obj->default('some faulty string');
    }
}
