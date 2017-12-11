<?php

namespace JTDSoft\Essentials;

class Currencies
{
    protected static $zero_decimal_currencies = [
        'JPY',
        'KRW',
        'PYG',
        'VND',
        'CLP',
        'ISK',
        'HUF',
    ];

    protected static $currencies = [
        'ALL' => ['Albania Lek', 'Lek', '&#76;&#101;&#107;'],
        'AFN' => ['Afghanistan Afghani', '؋', '&#1547;'],
        'ARS' => ['Argentina Peso', '$', '&#36;'],
        'AWG' => ['Aruba Guilder', 'ƒ', '&#402;'],
        'AUD' => ['Australia Dollar', '$', '&#36;'],
        'AZN' => ['Azerbaijan New Manat', 'ман', '&#1084;&#1072;&#1085;'],
        'BSD' => ['Bahamas Dollar', '$', '&#36;'],
        'BBD' => ['Barbados Dollar', '$', '&#36;'],
        'BYR' => ['Belarus Ruble', 'p.', '&#112;&#46;'],
        'BZD' => ['Belize Dollar', 'BZ$', '&#66;&#90;&#36;'],
        'BMD' => ['Bermuda Dollar', '$', '&#36;'],
        'BOB' => ['Bolivia Bolíviano', '$b', '&#36;&#98;'],
        'BAM' => ['Bosnia and Herzegovina Convertible Marka', 'KM', '&#75;&#77;'],
        'BWP' => ['Botswana Pula', 'P', '&#80;'],
        'BGN' => ['Bulgaria Lev', 'лв', '&#1083;&#1074;'],
        'BRL' => ['Brazil Real', 'R$', '&#82;&#36;'],
        'BND' => ['Brunei Darussalam Dollar', '$', '&#36;'],
        'KHR' => ['Cambodia Riel', '៛', '&#6107;'],
        'CAD' => ['Canada Dollar', '$', '&#36;'],
        'KYD' => ['Cayman Islands Dollar', '$', '&#36;'],
        'CLP' => ['Chile Peso', '$', '&#36;'],
        'CNY' => ['China Yuan Renminbi', '¥', '&#165;'],
        'COP' => ['Colombia Peso', '$', '&#36;'],
        'CRC' => ['Costa Rica Colon', '₡', '&#8353;'],
        'HRK' => ['Croatia Kuna', 'kn', '107, ;&#110;'],
        'CUP' => ['Cuba Peso', '₱', '&#8369;'],
        'CZK' => ['Czech Republic Koruna', 'Kč', '&#75;&#269;'],
        'DKK' => ['Denmark Krone', 'kr', '&#107;&#114;'],
        'DOP' => ['Dominican Republic Peso', 'RD$', '&#82;&#68;&#36;'],
        'XCD' => ['East Caribbean Dollar', '$', '&#36;'],
        'EGP' => ['Egypt Pound', '£', '&#163;'],
        'SVC' => ['El Salvador Colon', '$', '&#36;'],
        'EUR' => ['Euro Member Countries', '€', '&#8364;'],
        'FKP' => ['Falkland Islands (Malvinas) Pound', '£', '&#163;'],
        'FJD' => ['Fiji Dollar', '$', '&#36;'],
        'GHS' => ['Ghana Cedi', '¢', '&#162;'],
        'GIP' => ['Gibraltar Pound', '£', '&#163;'],
        'GTQ' => ['Guatemala Quetzal', 'Q', '&#81;'],
        'GGP' => ['Guernsey Pound', '£', '&#163;'],
        'GYD' => ['Guyana Dollar', '$', '&#36;'],
        'HNL' => ['Honduras Lempira', 'L', '&#76;'],
        'HKD' => ['Hong Kong Dollar', '$', '&#36;'],
        'HUF' => ['Hungary Forint', 'Ft', '&#70;&#116;'],
        'ISK' => ['Iceland Krona', 'kr', '&#107;&#114;'],
        'INR' => ['India Rupee', '', ''],
        'IDR' => ['Indonesia Rupiah', 'Rp', '&#82;&#112;'],
        'IRR' => ['Iran Rial', '﷼', '&#65020;'],
        'IMP' => ['Isle of Man Pound', '£', '&#163;'],
        'ILS' => ['Israel Shekel', '₪', '&#8362;'],
        'JMD' => ['Jamaica Dollar', 'J$', '&#74;&#36;'],
        'JPY' => ['Japan Yen', '¥', '&#165;'],
        'JEP' => ['Jersey Pound', '£', '&#163;'],
        'KZT' => ['Kazakhstan Tenge', 'лв', '&#1083;&#1074;'],
        'KPW' => ['Korea (North) Won', '₩', '&#8361;'],
        'KRW' => ['Korea (South) Won', '₩', '&#8361;'],
        'KGS' => ['Kyrgyzstan Som', 'лв', '&#1083;&#1074;'],
        'LAK' => ['Laos Kip', '₭', '&#8365;'],
        'LBP' => ['Lebanon Pound', '£', '&#163;'],
        'LRD' => ['Liberia Dollar', '$', '&#36;'],
        'MKD' => ['Macedonia Denar', 'ден', '&#1076;&#1077;&#1085;'],
        'MYR' => ['Malaysia Ringgit', 'RM', '&#82;&#77;'],
        'MUR' => ['Mauritius Rupee', '₨', '&#8360;'],
        'MXN' => ['Mexico Peso', '$', '&#36;'],
        'MNT' => ['Mongolia Tughrik', '₮', '&#8366;'],
        'MZN' => ['Mozambique Metical', 'MT', '&#77;&#84;'],
        'NAD' => ['Namibia Dollar', '$', '&#36;'],
        'NPR' => ['Nepal Rupee', '₨', '&#8360;'],
        'ANG' => ['Netherlands Antilles Guilder', 'ƒ', '&#402;'],
        'NZD' => ['New Zealand Dollar', '$', '&#36;'],
        'NIO' => ['Nicaragua Cordoba', 'C$', '&#67;&#36;'],
        'NGN' => ['Nigeria Naira', '₦', '&#8358;'],
        'NOK' => ['Norway Krone', 'kr', '&#107;&#114;'],
        'OMR' => ['Oman Rial', '﷼', '&#65020;'],
        'PKR' => ['Pakistan Rupee', '₨', '&#8360;'],
        'PAB' => ['Panama Balboa', 'B/.', '&#66;&#47;&#46;'],
        'PYG' => ['Paraguay Guarani', 'Gs', '&#71;&#115;'],
        'PEN' => ['Peru Sol', 'S/.', '&#83;&#47;&#46;'],
        'PHP' => ['Philippines Peso', '₱', '&#8369;'],
        'PLN' => ['Poland Zloty', 'zł', '&#122;&#322;'],
        'QAR' => ['Qatar Riyal', '﷼', '&#65020;'],
        'RON' => ['Romania New Leu', 'lei', '&#108;&#101;&#105;'],
        'RUB' => ['Russia Ruble', 'руб', '&#1088;&#1091;&#1073;'],
        'SHP' => ['Saint Helena Pound', '£', '&#163;'],
        'SAR' => ['Saudi Arabia Riyal', '﷼', '&#65020;'],
        'RSD' => ['Serbia Dinar', 'Дин.', '1044;&#1080;&#1085;&#46;'],
        'SCR' => ['Seychelles Rupee', '₨', '&#8360;'],
        'SGD' => ['Singapore Dollar', '$', '&#36;'],
        'SBD' => ['Solomon Islands Dollar', '$', '&#36;'],
        'SOS' => ['Somalia Shilling', 'S', '&#83;'],
        'ZAR' => ['South Africa Rand', 'R', '&#82;'],
        'LKR' => ['Sri Lanka Rupee', '₨', '&#8360;'],
        'SEK' => ['Sweden Krona', 'kr', '&#107;&#114;'],
        'CHF' => ['Switzerland Franc', 'CHF', '&#67;&#72;&#70;'],
        'SRD' => ['Suriname Dollar', '$', '&#36;'],
        'SYP' => ['Syria Pound', '£', '&#163;'],
        'TWD' => ['Taiwan New Dollar', 'NT$', '&#78;&#84;&#36;'],
        'THB' => ['Thailand Baht', '฿', '3647;'],
        'TTD' => ['Trinidad and Tobago Dollar', 'TT$', '&#84;&#84;&#36;'],
        'TRY' => ['Turkey Lira', '', ''],
        'TVD' => ['Tuvalu Dollar', '$', '&#36;'],
        'UAH' => ['Ukraine Hryvnia', '₴', '&#8372;'],
        'GBP' => ['United Kingdom Pound', '£', '&#163;'],
        'USD' => ['United States Dollar', '$', '&#36;'],
        'UYU' => ['Uruguay Peso', '$U', '&#36;&#85;'],
        'UZS' => ['Uzbekistan Som', 'лв', '&#1083;&#1074;'],
        'VEF' => ['Venezuela Bolivar', 'Bs', '&#66;&#115;'],
        'VND' => ['Viet Nam Dong', '₫', '&#8363;'],
        'YER' => ['Yemen Rial', '﷼', '&#65020;'],
        'ZWD' => ['Zimbabwe Dollar', 'Z$', '&#90;&#36;'],
    ];

    public static function existsByIso($iso)
    {
        return isset(static::$currencies[strtoupper($iso)]);
    }

    public static function getByIso($iso)
    {
        return static::$currencies[strtoupper($iso)] ?? null;
    }

    public static function getNameByIso($iso)
    {
        return static::getByIso($iso)[0] ?? null;
    }

    public static function getUtfSignByIso($iso)
    {
        return static::getByIso($iso)[1] ?? null;
    }

    public static function isZeroDecimal($iso)
    {
        return in_array($iso, self::$zero_decimal_currencies);
    }

    public static function getHtmlSign2ByIso($iso)
    {
        return static::getByIso($iso)[2] ?? null;
    }

    public static function all()
    {
        return self::$currencies;
    }
}
