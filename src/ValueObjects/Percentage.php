<?php

namespace DeeToo\Essentials\ValueObjects;

use DeeToo\Essentials\Exceptions\Error;

class Percentage extends ValueObject
{
    public $serialize = [
        'formatted',
        'formatted_no_decimal',
        'formatted_no_sign',
        'formatted_no_sign_no_decimal',
    ];

    public function __construct($value)
    {
        parent::__construct(intval($value));

        if (!is_numeric($this->value)) {
            throw new Error('Invalid percentage value :value', ['value' => $this->value]);
        }

        if ($this->value > 10000) {
            throw new Error('Percentage value :value cannot be more than 10000', ['value' => $this->value]);
        }

        if ($this->value < 0) {
            throw new Error('Percentage value :value cannot be more negative', ['value' => $this->value]);
        }
    }

    public function formatted()
    {
        return format()->percent($this->value);
    }

    public function formattedNoDecimal()
    {
        return format()->percent($this->value, false, true, false);
    }

    public function formattedNoSign()
    {
        return format()->percent($this->value, true);
    }

    public function formattedNoSignNoDecimal()
    {
        return format()->percent($this->value, true, true, false);
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
}
