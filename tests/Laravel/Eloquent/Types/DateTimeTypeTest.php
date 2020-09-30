<?php

namespace Tests\DeeToo\Essentials\Laravel\Eloquent\Types;

use DateTime;
use Tests\TestCase;
use DeeToo\Essentials\Laravel\Eloquent\Types\DateTimeType;

/**
 * Class DateTimeTypeTest
 *
 * @package Tests\DeeToo\Essentials\Laravel\Eloquent\Types
 */
class DateTimeTypeTest extends TestCase
{
    public function test_to_primitive()
    {
        $obj = new DateTimeType();

        $now = new DateTime();
        $this->assertSame($obj->castToPrimitive($now), $now->format(DateTimeType::$format));
    }

    public function test_cast_from_primitive()
    {
        $obj = new DateTimeType();

        $now = new DateTime();

        $this->assertSame($obj->castFromPrimitive($now->format($obj::$format))->getTimestamp(), $now->getTimestamp());

        $cast = $obj->castFromPrimitive($now->format(DateTimeType::$format));

        $this->assertInstanceOf(DateTime::class, $cast);
        $this->assertSame($cast->getTimestamp(), $now->getTimestamp());
    }

    public function test_passes_validates()
    {
        $obj = new DateTimeType();

        $obj->validate(new DateTime());

        $this->assertTrue(true);
    }

    public function test_fails_validates()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('must be a date time');

        $obj = new DateTimeType();

        $obj->validate('some string');
    }
}
