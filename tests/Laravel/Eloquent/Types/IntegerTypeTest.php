<?php

namespace Tests\DeeToo\Essentials\Laravel\Eloquent\Types;

use DeeToo\Essentials\Laravel\Eloquent\Types\IntegerType;
use Tests\TestCase;

/**
 * Class IntegerTypeTest
 *
 * @package Tests\DeeToo\Essentials\Laravel\Eloquent\Types
 */
class IntegerTypeTest extends TestCase
{
    public function test_passes_validates()
    {
        $obj = new IntegerType();

        $obj->validate(1);

        $this->assertTrue(true);
    }

    /**
     * @expectedException \DeeToo\Essentials\Exceptions\Error
     * @expectedExceptionMessage must be integer
     */
    public function test_fails_validates()
    {
        $obj = new IntegerType();

        $obj->validate('some value');
    }

    /**
     * @expectedException \DeeToo\Essentials\Exceptions\Error
     * @expectedExceptionMessage cannot be more than 5
     */
    public function test_validation_fails_if_value_more_than_max()
    {
        $obj = (new IntegerType())->max(5);

        $obj->validate(6);
    }

    /**
     * @expectedException \DeeToo\Essentials\Exceptions\Error
     * @expectedExceptionMessage cannot be less than 2
     */
    public function test_validation_fails_if_value_lass_than_min()
    {
        $obj = (new IntegerType())->min(2);

        $obj->validate(1);
    }

    /**
     * @expectedException \DeeToo\Essentials\Exceptions\Error
     * @expectedExceptionMessage cannot be less than 0
     */
    public function test_validation_fails_if_value_lass_than_0_when_unsigned()
    {
        $obj = (new IntegerType())->unsigned();

        $obj->validate(-1);
    }

    /**
     * @expectedException \DeeToo\Essentials\Exceptions\Error
     * @expectedExceptionMessage cannot be more than 2147483647
     */
    public function test_validation_cannot_be_more_than_type_max()
    {
        $obj = (new IntegerType());

        $obj->validate(2 ** 33);
    }

    /**
     * @expectedException \DeeToo\Essentials\Exceptions\Error
     * @expectedExceptionMessage cannot be less than -2147483648
     */
    public function test_validation_cannot_be_lass_than_type_max()
    {
        $obj = (new IntegerType());

        $obj->validate(- 2 ** 33);
    }
}
