<?php

namespace Tests\JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Laravel\Eloquent\Types\FloatType;
use Tests\TestCase;

/**
 * Class FloatTypeTest
 *
 * @package Tests\JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class FloatTypeTest extends TestCase
{
    public function test_passes_validates()
    {
        $obj = new FloatType();

        $obj->validate('foo', 1.2);

        $this->assertTrue(true);
    }

    /**
     * @expectedException \JTDSoft\Essentials\Exceptions\Error
     * @expectedExceptionMessage foo must be float
     */
    public function test_fails_validates()
    {
        $obj = new FloatType();

        $obj->validate('foo', 'some value');
    }

    /**
     * @expectedException \JTDSoft\Essentials\Exceptions\Error
     * @expectedExceptionMessage foo cannot be more than 5
     */
    public function test_validation_fails_if_value_more_than_max()
    {
        $obj = (new FloatType())->max(5);

        $obj->validate('foo', 5.1);
    }

    /**
     * @expectedException \JTDSoft\Essentials\Exceptions\Error
     * @expectedExceptionMessage foo cannot be less than 1
     */
    public function test_validation_fails_if_value_lass_than_min()
    {
        $obj = (new FloatType())->min(1);

        $obj->validate('foo', 0.1);
    }

    /**
     * @expectedException \JTDSoft\Essentials\Exceptions\Error
     * @expectedExceptionMessage foo cannot be less than 0
     */
    public function test_validation_fails_if_value_lass_than_0_when_unsigned()
    {
        $obj = (new FloatType())->unsigned();

        $obj->validate('foo', -0.1);
    }
}
