<?php

namespace DeeToo\Essentials;

use DeeToo\Essentials\Exceptions\Error;
use ReflectionClass;

class Countries
{
    protected static $countries = [];

    protected static $aliases = [
        'England'       => 'GB',
        'Wales'         => 'GB',
        'Scotland'      => 'GB',
        'Great Britain' => 'GB',
        'UK'            => 'GB',
    ];

    protected static function load()
    {
        if (self::$countries) {
            return;
        }

        $reflection = new ReflectionClass(\Composer\Autoload\ClassLoader::class);
        $vendorDir = dirname(dirname($reflection->getFileName()));

        self::$countries = include("{$vendorDir}/umpirsky/country-list/data/en_GB/country.php");
    }

    public static function existsByIso($iso)
    {
        self::load();

        return isset(static::$countries[strtoupper($iso)]);
    }

    public static function getByIso($iso)
    {
        self::load();

        return static::$countries[strtoupper($iso)] ?? null;
    }

    public static function getNameByIso($iso)
    {
        return static::getByIso($iso) ?? null;
    }

    public static function getIsoByName(string $name)
    {
        self::load();

        $name = strtolower($name);

        foreach (self::$aliases as $alias => $iso) {
            if ($name === strtolower($alias)) {
                return $iso;
            }
        }

        return array_search($name, array_map('strtolower', static::$countries));
    }

    public static function existsByName(string $name)
    {
        return !empty(static::getIsoByName($name));
    }

    public static function all()
    {
        self::load();

        return self::$countries;
    }

    public static function allPostcoderStyle(string $country = null)
    {
        if ($country) {
            $iso = self::getIsoByName($country);

            if (!$iso) {
                throw new Error('No information found for this country');
            }

            return [
                'iso'  => $iso,
                'name' => self::getNameByIso($iso),
            ];
        } else {
            self::load();

            $countries = [];

            foreach (self::$countries as $iso => $countryname) {
                $countries[] = [
                    'iso'  => $iso,
                    'name' => $countryname,
                ];
            }

            return $countries;
        }
    }
}
