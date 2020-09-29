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

    public function test_fails_validates()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('must be integer');

        $obj = new IntegerType();

        $obj->validate('some value');
    }

    public function test_validation_fails_if_value_more_than_max()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('cannot be more than 5');

        $obj = (new IntegerType())->max(5);

        $obj->validate(6);
    }

    public function test_validation_fails_if_value_lass_than_min()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('cannot be less than 2');

        $obj = (new IntegerType())->min(2);

        $obj->validate(1);
    }

    public function test_validation_fails_if_value_lass_than_0_when_unsigned()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('cannot be less than 0');

        $obj = (new IntegerType())->unsigned();

        $obj->validate(-1);
    }

    public function test_validation_cannot_be_more_than_type_max()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('cannot be more than 2147483647');

        $obj = (new IntegerType());

        $obj->validate(2 ** 33);
    }

    public function test_validation_cannot_be_lass_than_type_max()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('cannot be less than -2147483648');

        $obj = (new IntegerType());

        $obj->validate(- 2 ** 33);
    }
}
