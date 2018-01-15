<?php

namespace Tests\JTDSoft\Essentials\Laravel\Eloquent\Types;

use JTDSoft\Essentials\Laravel\Eloquent\Types\EmailType;
use Tests\TestCase;

/**
 * Class EmailTypeTest
 *
 * @package Tests\JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class EmailTypeTest extends TestCase
{
    public function test_passes_validates()
    {
        $obj = new EmailType();

        $obj->validate('jordan.dobrev.88@gmail.com');

        $this->assertTrue(true);
    }

    /**
     * @expectedException \JTDSoft\Essentials\Exceptions\Error
     * @expectedExceptionMessage must be a valid email address
     */
    public function test_fails_validates()
    {
        $obj = new EmailType();

        $obj->validate('some string');
    }
}
