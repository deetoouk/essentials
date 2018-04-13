<?php

namespace Tests\DeeToo\Essentials\Laravel\Eloquent\Types;

use DeeToo\Essentials\Laravel\Eloquent\Types\FloatType;
use Tests\TestCase;

/**
 * Class FloatTypeTest
 *
 * @package Tests\DeeToo\Essentials\Laravel\Eloquent\Types
 */
class FloatTypeTest extends TestCase
{
    public function test_passes_validates()
    {
        $obj = new FloatType();

        $obj->validate(1.2);

        $this->assertTrue(true);
    }

    /**
     * @expectedException \DeeToo\Essentials\Exceptions\Error
     * @expectedExceptionMessage must be float
     */
    public function test_fails_validates()
    {
        $obj = new FloatType();

        $obj->validate('some value');
    }

    /**
     * @expectedException \DeeToo\Essentials\Exceptions\Error
     * @expectedExceptionMessage cannot be more than 5
     */
    public function test_validation_fails_if_value_more_than_max()
    {
        $obj = (new FloatType())->max(5);

        $obj->validate(5.1);
    }

    /**
     * @expectedException \DeeToo\Essentials\Exceptions\Error
     * @expectedExceptionMessage cannot be less than 1
     */
    public function test_validation_fails_if_value_lass_than_min()
    {
        $obj = (new FloatType())->min(1);

        $obj->validate(0.1);
    }

    /**
     * @expectedException \DeeToo\Essentials\Exceptions\Error
     * @expectedExceptionMessage cannot be less than 0
     */
    public function test_validation_fails_if_value_lass_than_0_when_unsigned()
    {
        $obj = (new FloatType())->unsigned();

        $obj->validate(-0.1);
    }
}
