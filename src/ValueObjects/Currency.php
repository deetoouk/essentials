<?php

namespace JTDSoft\Essentials\ValueObjects;

use JTDSoft\Essentials\Exceptions\Error;
use JTDSoft\Essentials\Currencies;

class Currency extends ValueObject
{
    public $serialize = [
        'name',
        'iso',
        'sign_utf',
        'sign_html',
    ];

    public function __construct($value)
    {
        parent::__construct(strtoupper($value));

        if (!is_string($this->value) || strlen($this->value) !== 3) {
            throw new Error('Invalid currency value :value', ['value' => $this->value]);
        }

        assert(Currencies::existsByIso($this->value), __('Currency does not exist: :value', ['value' => $this->value]));
    }

    public function name()
    {
        return Currencies::getNameByIso($this->value);
    }

    public function signUtf()
    {
        return Currencies::getUtfSignByIso($this->value);
    }

    public function signHtml()
    {
        return Currencies::getHtmlSign2ByIso($this->value);
    }

    public function iso()
    {
        return $this->value;
    }
}
