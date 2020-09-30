<?php

namespace Tests\DeeToo\Essentials\Laravel\Eloquent\Types;

use DeeToo\Essentials\Laravel\Eloquent\Types\EnumerableType;
use Tests\TestCase;

/**
 * Class EnumerableTypeTest
 *
 * @package Tests\DeeToo\Essentials\Laravel\Eloquent\Types
 */
class EnumerableTypeTest extends TestCase
{
    public function test_passes_validates()
    {
        $obj = new EnumerableType(['one', 'two']);

        $obj->validate('one');

        $this->assertTrue(true);
    }

    public function test_fails_validates()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('invalid value');

        $obj = new EnumerableType(['one', 'two']);

        $obj->validate('some value');
    }
}
