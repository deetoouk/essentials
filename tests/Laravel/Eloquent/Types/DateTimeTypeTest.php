<?php

namespace Tests\JTDSoft\Essentials\Laravel\Eloquent\Types;

use DateTime;
use JTDSoft\Essentials\Laravel\Eloquent\Types\DateTimeType;
use Tests\TestCase;

/**
 * Class DateTimeTypeTest
 *
 * @package Tests\JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class DateTimeTypeTest extends TestCase
{
    public function test_to_primitive()
    {
        $obj = new DateTimeType();

        $now = new DateTime();
        $this->assertSame($obj->castToPrimitive(new $now), $now->format(DateTimeType::$format));
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

    /**
     * @expectedException \JTDSoft\Essentials\Exceptions\Error
     * @expectedExceptionMessage must be a date time
     */
    public function test_fails_validates()
    {
        $obj = new DateTimeType();

        $obj->validate('some string');
    }
}
