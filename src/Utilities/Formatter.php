<?php

namespace JordanDobrev\Essentials\Utilities;

use DateTime;
use JordanDobrev\Essentials\Currencies;
use JordanDobrev\Essentials\ValueObjects\Currency;

class Formatter
{
    public function money($amount, $zero_decimal = false)
    {
        if ($zero_decimal) {
            return $amount;
        } else {
            $whole = intval($amount / 100);
            $coins = $amount % 100;

            return sprintf('%1$d.%2$02d', $whole, $coins);
        }
    }

    public function currency($amount, $currency, $exclude_sign = false, $html = false)
    {
        if ($currency instanceof Currency) {
            $currency = $currency->value;
        }

        $sign_after = true;

        $formatted = $this->money($amount, Currencies::isZeroDecimal($currency));

        if ($html) {
            if (Currencies::getHtmlSign2ByIso($currency)) {
                $sign_after = false;
                $currency   = Currencies::getHtmlSign2ByIso($currency);
            }
        } else {
            if (Currencies::getUtfSignByIso($currency)) {
                $sign_after = false;
                $currency   = Currencies::getUtfSignByIso($currency);
            }
        }

        if (!$exclude_sign) {
            if ($sign_after) {
                $formatted = sprintf('%1$s %2$s', $formatted, $currency);
            } else {
                $formatted = sprintf('%2$s %1$s', $formatted, $currency);
            }
        }

        return $formatted;
    }

    public function percent($percent, $exclude_sign = false, $round = true, $with_decimals = true)
    {
        $percent = $round ? round($percent, 0) : $percent;
        if ($with_decimals) {
            $whole     = intval($percent / 100);
            $decimals  = $percent % 100;
            $formatted = sprintf('%1$d.%2$02d', $whole, $decimals);
        } else {
            $formatted = round($percent / 100);
        }

        if (!$exclude_sign) {
            $formatted = $formatted . '%';
        }

        return $formatted;
    }

    public function number($number)
    {
        return number_format($number, 0, '.', '');
    }

    public function date(string $date)
    {
        $date = new DateTime($date);

        return $date->format('Y-m-d H:i:s');
    }

    public function dateTimeHuman(DateTime $dateTime)
    {
        return $dateTime->format("l F jS Y \\a\\t h:i a");
    }
}
