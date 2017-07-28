<?php

namespace Tests\JTDSoft\Essentials\Laravel\Eloquent\Types;

use DateTime;
use JTDSoft\Essentials\Laravel\Eloquent\Types\DateType;
use Tests\TestCase;

/**
 * Class DateTypeTest
 *
 * @package Tests\JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class DateTypeTest extends TestCase
{
    public function test_to_primitive()
    {
        $obj = new DateType();

        $now = new DateTime();
        $this->assertSame($obj->toPrimitive(new $now), $now->format(DateType::$format));
    }

    public function test_cast()
    {
        $obj = new DateType();

        $now = (new DateTime())->modify('midnight');

        $this->assertSame($obj->cast($now)->getTimestamp(), $now->getTimestamp());

        $cast = $obj->cast($now->format(DateType::$format));

        $this->assertInstanceOf(DateTime::class, $cast);
        $this->assertSame($cast->getTimestamp(), $now->getTimestamp());
    }

    public function test_passes_validates()
    {
        $obj = new DateType();

        $obj->validate('foo', new DateTime());

        $this->assertTrue(true);
    }

    /**
     * @expectedException \JTDSoft\Essentials\Exceptions\Error
     * @expectedExceptionMessage foo must be a date time object
     */
    public function test_fails_validates()
    {
        $obj = new DateType();

        $obj->validate('foo', 'some string');
    }
}
