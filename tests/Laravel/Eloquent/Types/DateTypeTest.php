<?php

namespace Tests\DeeToo\Essentials\Laravel\Eloquent\Types;

use DateTime;
use DeeToo\Essentials\Laravel\Eloquent\Types\DateType;
use Tests\TestCase;

/**
 * Class DateTypeTest
 *
 * @package Tests\DeeToo\Essentials\Laravel\Eloquent\Types
 */
class DateTypeTest extends TestCase
{
    public function test_to_primitive()
    {
        $obj = new DateType();

        $now = new DateTime();
        $this->assertSame($obj->castToPrimitive(new $now), $now->format(DateType::$format));
    }

    public function test_cast_from_primitive()
    {
        $obj = new DateType();

        $now = (new DateTime())->modify('midnight');

        $this->assertSame($obj->castFromPrimitive($now->format($obj::$format))->getTimestamp(), $now->getTimestamp());

        $cast = $obj->castFromPrimitive($now->format(DateType::$format));

        $this->assertInstanceOf(DateTime::class, $cast);
        $this->assertSame($cast->getTimestamp(), $now->getTimestamp());
    }

    public function test_passes_validates()
    {
        $obj = new DateType();

        $obj->validate(new DateTime());

        $this->assertTrue(true);
    }

    /**
     * @expectedException \DeeToo\Essentials\Exceptions\Error
     * @expectedExceptionMessage must be a date
     */
    public function test_fails_validates()
    {
        $obj = new DateType();

        $obj->validate('some string');
    }
}
