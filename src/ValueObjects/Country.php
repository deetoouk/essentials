<?php

namespace JTDSoft\Essentials\ValueObjects;

use JTDSoft\Essentials\Countries;
use JTDSoft\Essentials\Exceptions\Error;

class Country extends ValueObject
{
    public $serialize = [
        'name',
        'iso',
    ];

    protected $resolved = false;

    public function __construct($value)
    {
        parent::__construct($value);

        if (!is_string($this->value)) {
            throw new Error('Invalid country value :value', ['value' => $this->value]);
        }

        $this->resolveIso();

        if ($this->resolved) {
            return;
        }

        throw new Error('Invalid country value :value', ['value' => $this->value]);
    }

    private function resolveIso()
    {
        if (strlen($this->value) === 2) {
            $this->value = strtoupper($this->value);

            if (Countries::existsByIso($this->value)) {
                $this->resolved = true;

                return;
            }
        }

        if (Countries::existsByName($this->value)) {
            $this->value = Countries::getIsoByName($this->value);

            $this->resolved = true;

            return;
        }
    }

    public function iso()
    {
        return $this->value;
    }

    public function name()
    {
        return Countries::getByIso($this->value);
    }
}
