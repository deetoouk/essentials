<?php

namespace Tests\DeeToo\Essentials\ValueObjects;

use DeeToo\Essentials\ValueObjects\Country;
use Tests\TestCase;

class CountryTest extends TestCase
{
    public function test_fails_on_invalid_value_type()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('Invalid country value 123');

        new Country(123);
    }

    public function test_fails_on_invalid_value()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('Invalid country value AAAA');

        new Country('AAAA');
    }

    public function test_finds_country_by_iso()
    {
        new Country('BG');

        $this->assertTrue(true);
    }

    public function test_fails_on_invalid_iso()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('Invalid country value AA');

        new Country('AA');
    }

    public function test_finds_country_by_name()
    {
        $country = new Country('Bulgaria');

        $this->assertSame($country->iso(), 'BG');
    }

    public function test_finds_country_by_uppercase_name()
    {
        $country = new Country('BULGARIA');

        $this->assertSame($country->iso(), 'BG');
    }

    public function test_fails_on_made_up_country()
    {
        $this->expectException(\DeeToo\Essentials\Exceptions\Error::class);
        $this->expectExceptionMessage('Invalid country value BulgaroBritania');

        new Country('BulgaroBritania');
    }

    public function test_finds_by_alias()
    {
        $country = new Country('Great Britain');

        $this->assertSame($country->iso(), 'GB');
    }

    public function test_finds_by_iso_alias()
    {
        $country = new Country('UK');

        $this->assertSame($country->iso(), 'GB');
    }
}
