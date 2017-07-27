<?php

namespace Tests\JordanDobrev\Essentials\ValueObjects;

use JordanDobrev\Essentials\ValueObjects\Country;
use Tests\TestCase;

class CountryTest extends TestCase
{
    /**
     * @expectedException \JordanDobrev\Essentials\Exceptions\Error
     */
    public function test_fails_on_invalid_value_type()
    {
        new Country(123);
    }

    /**
     * @expectedException \JordanDobrev\Essentials\Exceptions\Error
     */
    public function test_fails_on_invalid_value()
    {
        new Country('AAAA');
    }

    public function test_finds_country_by_iso()
    {
        new Country('BG');

        $this->assertTrue(true);
    }

    /**
     * @expectedException \JordanDobrev\Essentials\Exceptions\Error
     */
    public function test_fails_on_invalid_iso()
    {
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

    /**
     * @expectedException \JordanDobrev\Essentials\Exceptions\Error
     */
    public function test_fails_on_made_up_country()
    {
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
