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

    public function test_fails_validates()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('must be float');

        $obj = new FloatType();

        $obj->validate('some value');
    }

    public function test_validation_fails_if_value_more_than_max()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('cannot be more than 5');

        $obj = (new FloatType())->max(5);

        $obj->validate(5.1);
    }

    public function test_validation_fails_if_value_lass_than_min()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('cannot be less than 1');

        $obj = (new FloatType())->min(1);

        $obj->validate(0.1);
    }

    public function test_validation_fails_if_value_lass_than_0_when_unsigned()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('cannot be less than 0');

        $obj = (new FloatType())->unsigned();

        $obj->validate(-0.1);
    }
}
