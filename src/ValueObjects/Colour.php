<?php

namespace JordanDobrev\Essentials\ValueObjects;

use JordanDobrev\Essentials\Exceptions\Error;

/**
 * Value object class for representing colours
 *
 * @author laurence
 */
class Colour extends ValueObject
{
    public $serialize = [
        'hex',
        'decimal',
        'hexstring',
    ];

    public function __construct(string $value)
    {
        // Lower case and strip hash
        $value = ltrim(strtoupper($value), "#");

        $valueArray = [];

        // Validate input, should be something like: FF0000, f00, a0b69c etc.
        if (!preg_match('/((^[A-F0-9]{3}$)|(^[A-F0-9]{6}$))/', $value)) {
            throw new Error('Invalid colour code :value, must be RGB Hex string e.g. #FFFFFF or fff', ['value']);
        }

        if (strlen($value) === 3) {
            // Is a valid short colour code
            $valueArray['red']   = str_repeat(substr($value, 0, 1), 2);
            $valueArray['green'] = str_repeat(substr($value, 1, 1), 2);
            $valueArray['blue']  = str_repeat(substr($value, 2, 1), 2);
        } elseif (strlen($value) === 6) {
            // Is a valid long colour code
            $valueArray['red']   = substr($value, 0, 2);
            $valueArray['green'] = substr($value, 2, 2);
            $valueArray['blue']  = substr($value, 4, 2);
        }

        parent::__construct($valueArray);
    }

    /**
     * Returns an RGB hex string e.g. #FF00AA
     *
     * @return string
     */
    public function hexstring(): string
    {
        return "#" . implode(array_values($this->value));
    }

    /**
     * Returns an array of decimal RGB values e.g.
     * array ("red" => "255",  "green" => 170, "blue" => 135 )
     *
     * @return array
     */
    public function decimal(): array
    {
        $valueArray = $this->value;
        // Go through array, convert hexes to decs.
        array_walk($valueArray, function (&$value, $key) {
            $value = hexdec($value);
        });

        return $valueArray;
    }

    /**
     * Returns an array of hex RGB values e.g.
     * array ("red" => "FF", "green" => "00", "blue" => "AA")
     *
     * @return array
     */
    public function hex(): array
    {
        return $this->value;
    }

    public function toPrimitive(): string
    {
        return implode(array_values($this->value));
    }

    public function value(): string
    {
        return $this->hexstring();
    }
}
