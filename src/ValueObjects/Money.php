<?php

namespace DeeToo\Essentials\ValueObjects;

use DeeToo\Essentials\Exceptions\Error;

class Money extends ValueObject
{
    /**
     * @var Currency
     */
    private Currency $currency;

    public static string $defaultCurrency = 'GBP';

    public array $serialize = [
        'in_smallest_unit',
        'formatted',
        'formatted_html',
        'formatted_no_sign',
    ];

    public function __construct($value, Currency $currency = null)
    {
        if (!is_numeric($value)) {
            throw new Error('Invalid money value :value', ['value' => $value]);
        }

        parent::__construct(intval($value));

        $this->currency = $currency ?? new Currency(self::$defaultCurrency);
    }

    public function inSmallestUnit(): int
    {
        return $this->value;
    }

    public function formatted(): string
    {
        return format()->currency($this->value, $this->currency);
    }

    public function formattedHtml(): string
    {
        return format()->currency($this->value, $this->currency, false, true);
    }

    public function formattedNoSign(): string
    {
        return format()->currency($this->value, $this->currency, true);
    }

    public function isPositive(): bool
    {
        return $this->value > 0;
    }

    public function isNegative(): bool
    {
        return $this->value < 0;
    }

    public function isMoreThan($amount): bool
    {
        if ($amount instanceof self) {
            $amount = $amount->value;
        }

        return $this->value > $amount;
    }

    public function isLessThan($amount): bool
    {
        if ($amount instanceof self) {
            $amount = $amount->value;
        }

        return $this->value < $amount;
    }

    public function add($amount)
    {
        if ($amount instanceof self) {
            $amount = $amount->value;
        }

        $this->value += $amount;
    }

    public function subtract($amount)
    {
        if ($amount instanceof self) {
            $amount = $amount->value;
        }

        $this->value -= $amount;
    }
}
