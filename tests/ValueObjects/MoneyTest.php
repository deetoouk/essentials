<?php

namespace Tests\DeeToo\Essentials\ValueObjects;

use DeeToo\Essentials\ValueObjects\Currency;
use DeeToo\Essentials\ValueObjects\Money;
use Tests\TestCase;

class MoneyTest extends TestCase
{
    /**
     * @expectedException \DeeToo\Essentials\Exceptions\Error
     */
    public function test_fails_on_invalid_value_type()
    {
        new Money('aba');
    }

    public function test_does_not_fail_on_negative()
    {
        new Money(-100);

        $this->assertTrue(true);
    }

    public function test_formats_decimal_currencies()
    {
        $currency = new Currency('GBP');

        $money = new Money(100, $currency);

        $this->assertSame($money->formatted(), '£ 1.00');
        $this->assertSame($money->inSmallestUnit(), 100);
        $this->assertSame($money->formattedHtml(), '&#163; 1.00');
        $this->assertSame($money->formattedNoSign(), '1.00');
    }

    public function test_formats_zero_decimal_currencies()
    {
        $currency = new Currency('ISK');

        $money = new Money(100, $currency);

        $this->assertSame($money->formatted(), 'kr 100');
        $this->assertSame($money->inSmallestUnit(), 100);
        $this->assertSame($money->formattedHtml(), '&#107;&#114; 100');
        $this->assertSame($money->formattedNoSign(), '100');
    }
}
