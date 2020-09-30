<?php

namespace Tests\DeeToo\Essentials\Laravel\Eloquent\Types;

use DeeToo\Essentials\Laravel\Eloquent\Types\EmailType;
use Tests\TestCase;

/**
 * Class EmailTypeTest
 *
 * @package Tests\DeeToo\Essentials\Laravel\Eloquent\Types
 */
class EmailTypeTest extends TestCase
{
    public function test_passes_validates()
    {
        $obj = new EmailType();

        $obj->validate('jordan.dobrev.88@gmail.com');

        $this->assertTrue(true);
    }

    public function test_fails_validates()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('must be a valid email address');

        $obj = new EmailType();

        $obj->validate('some string');
    }
}
