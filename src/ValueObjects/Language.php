<?php

namespace JTDSoft\Essentials\ValueObjects;

use JTDSoft\Essentials\Exceptions\Error;
use JTDSoft\Essentials\Services\Languages;

class Language extends ValueObject
{
    public $serialize = [
        'name',
        'native_name',
        'iso',
        'iso2',
    ];

    public function __construct($value)
    {
        parent::__construct(strtolower($value));

        if (!is_string($value) || strlen($value) !== 2) {
            throw new Error('Invalid language value :value', compact('value'));
        }

        assert(Languages::existsByIso($this->value), __('Language does not exist: :value', ['value' => $value]));
    }

    public function name()
    {
        return Languages::getNameByIso($this->value);
    }

    public function nativeName()
    {
        return Languages::getNativeNameByIso($this->value);
    }

    public function iso()
    {
        return $this->value;
    }

    public function iso2()
    {
        return Languages::getIso2ByIso($this->value);
    }
}
