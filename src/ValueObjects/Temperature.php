<?php

namespace DeeToo\Essentials\ValueObjects;

use DeeToo\Essentials\Exceptions\Error;

class Temperature extends ValueObject
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
            throw new Error('Invalid temperature value :value', ['value' => $this->value]);
        }

        if ($this->value > PHP_INT_MAX) {
            throw new Error(
                'Temperature value :value cannot be more than max integer value',
                ['value' => $this->value]
            );
        }

        if ($this->value < -27315) {
            throw new Error('Temperature value :value cannot be less than absolute 0', ['value' => $this->value]);
        }
    }

    public function formatted()
    {
        return format()->temperature($this->value);
    }

    public function formattedNoDecimal()
    {
        return format()->temperature($this->value, false, true, false);
    }

    public function formattedNoSign()
    {
        return format()->temperature($this->value, true);
    }

    public function formattedNoSignNoDecimal()
    {
        return format()->temperature($this->value, true, true, false);
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
