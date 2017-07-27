<?php

namespace JTDSoft\Essentials\Utilities;

use JTDSoft\Essentials\Exceptions\Error;

class Colours
{

    /**
     * Records how far the palette 'random' calls are
     *
     * @var [type]
     */
    protected $palettePointer;

    protected $palette = [
        'green'       => [
            50  => ['background' => '#E8F5E9', 'text' => '#000000'],
            100 => ['background' => '#C8E6C9', 'text' => '#000000'],
            200 => ['background' => '#A5D6A7', 'text' => '#000000'],
            300 => ['background' => '#81C784', 'text' => '#000000'],
            400 => ['background' => '#66BB6A', 'text' => '#000000'],
            500 => ['background' => '#4CAF50', 'text' => '#000000'],
            600 => ['background' => '#43A047', 'text' => '#FFFFFF'],
            700 => ['background' => '#388E3C', 'text' => '#FFFFFF'],
            800 => ['background' => '#2E7D32', 'text' => '#FFFFFF'],
            900 => ['background' => '#1B5E20', 'text' => '#FFFFFF'],
        ],
        'blue grey'   => [
            50  => ['background' => '#ECEFF1', 'text' => '#000000'],
            100 => ['background' => '#CFD8DC', 'text' => '#000000'],
            200 => ['background' => '#B0BEC5', 'text' => '#000000'],
            300 => ['background' => '#90A4AE', 'text' => '#000000'],
            400 => ['background' => '#78909C', 'text' => '#FFFFFF'],
            500 => ['background' => '#607D8B', 'text' => '#FFFFFF'],
            600 => ['background' => '#546E7A', 'text' => '#FFFFFF'],
            700 => ['background' => '#455A64', 'text' => '#FFFFFF'],
            800 => ['background' => '#37474F', 'text' => '#FFFFFF'],
            900 => ['background' => '#263238', 'text' => '#FFFFFF'],
        ],
        'orange'      => [
            50  => ['background' => '#FFF3E0', 'text' => '#000000'],
            100 => ['background' => '#FFE0B2', 'text' => '#000000'],
            200 => ['background' => '#FFCC80', 'text' => '#000000'],
            300 => ['background' => '#FFB74D', 'text' => '#000000'],
            400 => ['background' => '#FFA726', 'text' => '#000000'],
            500 => ['background' => '#FF9800', 'text' => '#000000'],
            600 => ['background' => '#FB8C00', 'text' => '#000000'],
            700 => ['background' => '#F57C00', 'text' => '#000000'],
            800 => ['background' => '#EF6C00', 'text' => '#FFFFFF'],
            900 => ['background' => '#E65100', 'text' => '#FFFFFF'],
        ],
        'purple'      => [
            50  => ['background' => '#F3E5F5', 'text' => '#000000'],
            100 => ['background' => '#E1BEE7', 'text' => '#000000'],
            200 => ['background' => '#CE93D8', 'text' => '#000000'],
            300 => ['background' => '#BA68C8', 'text' => '#FFFFFF'],
            400 => ['background' => '#AB47BC', 'text' => '#FFFFFF'],
            500 => ['background' => '#9C27B0', 'text' => '#FFFFFF'],
            600 => ['background' => '#8E24AA', 'text' => '#FFFFFF'],
            700 => ['background' => '#7B1FA2', 'text' => '#FFFFFF'],
            800 => ['background' => '#6A1B9A', 'text' => '#FFFFFF'],
            900 => ['background' => '#4A148C', 'text' => '#FFFFFF'],
        ],
        'red'         => [
            50  => ['background' => '#FFEBEE', 'text' => '#000000'],
            100 => ['background' => '#FFCDD2', 'text' => '#000000'],
            200 => ['background' => '#EF9A9A', 'text' => '#000000'],
            300 => ['background' => '#E57373', 'text' => '#000000'],
            400 => ['background' => '#EF5350', 'text' => '#FFFFFF'],
            500 => ['background' => '#F44336', 'text' => '#FFFFFF'],
            600 => ['background' => '#E53935', 'text' => '#FFFFFF'],
            700 => ['background' => '#D32F2F', 'text' => '#FFFFFF'],
            800 => ['background' => '#C62828', 'text' => '#FFFFFF'],
            900 => ['background' => '#B71C1C', 'text' => '#FFFFFF'],
        ],
        'pink'        => [
            50  => ['background' => '#FCE4EC', 'text' => '#000000'],
            100 => ['background' => '#F8BBD0', 'text' => '#000000'],
            200 => ['background' => '#F48FB1', 'text' => '#000000'],
            300 => ['background' => '#F06292', 'text' => '#FFFFFF'],
            400 => ['background' => '#EC407A', 'text' => '#FFFFFF'],
            500 => ['background' => '#E91E63', 'text' => '#FFFFFF'],
            600 => ['background' => '#D81B60', 'text' => '#FFFFFF'],
            700 => ['background' => '#C2185B', 'text' => '#FFFFFF'],
            800 => ['background' => '#AD1457', 'text' => '#FFFFFF'],
            900 => ['background' => '#880E4F', 'text' => '#FFFFFF'],
        ],
        'indigo'      => [
            50  => ['background' => '#E8EAF6', 'text' => '#000000'],
            100 => ['background' => '#C5CAE9', 'text' => '#000000'],
            200 => ['background' => '#9FA8DA', 'text' => '#000000'],
            300 => ['background' => '#7986CB', 'text' => '#FFFFFF'],
            400 => ['background' => '#5C6BC0', 'text' => '#FFFFFF'],
            500 => ['background' => '#3F51B5', 'text' => '#FFFFFF'],
            600 => ['background' => '#3949AB', 'text' => '#FFFFFF'],
            700 => ['background' => '#303F9F', 'text' => '#FFFFFF'],
            800 => ['background' => '#283593', 'text' => '#FFFFFF'],
            900 => ['background' => '#1A237E', 'text' => '#FFFFFF'],
        ],
        'deep purple' => [
            50  => ['background' => '#EDE7F6', 'text' => '#000000'],
            100 => ['background' => '#D1C4E9', 'text' => '#000000'],
            200 => ['background' => '#B39DDB', 'text' => '#000000'],
            300 => ['background' => '#9575CD', 'text' => '#FFFFFF'],
            400 => ['background' => '#7E57C2', 'text' => '#FFFFFF'],
            500 => ['background' => '#673AB7', 'text' => '#FFFFFF'],
            600 => ['background' => '#5E35B1', 'text' => '#FFFFFF'],
            700 => ['background' => '#512DA8', 'text' => '#FFFFFF'],
            800 => ['background' => '#4527A0', 'text' => '#FFFFFF'],
            900 => ['background' => '#311B92', 'text' => '#FFFFFF'],
        ],
        'blue'        => [
            50  => ['background' => '#E3F2FD', 'text' => '#000000'],
            100 => ['background' => '#BBDEFB', 'text' => '#000000'],
            200 => ['background' => '#90CAF9', 'text' => '#000000'],
            300 => ['background' => '#64B5F6', 'text' => '#000000'],
            400 => ['background' => '#42A5F5', 'text' => '#000000'],
            500 => ['background' => '#2196F3', 'text' => '#FFFFFF'],
            600 => ['background' => '#1E88E5', 'text' => '#FFFFFF'],
            700 => ['background' => '#1976D2', 'text' => '#FFFFFF'],
            800 => ['background' => '#1565C0', 'text' => '#FFFFFF'],
            900 => ['background' => '#0D47A1', 'text' => '#FFFFFF'],
        ],
        'light blue'  => [
            50  => ['background' => '#E1F5FE', 'text' => '#000000'],
            100 => ['background' => '#B3E5FC', 'text' => '#000000'],
            200 => ['background' => '#81D4FA', 'text' => '#000000'],
            300 => ['background' => '#4FC3F7', 'text' => '#000000'],
            400 => ['background' => '#29B6F6', 'text' => '#000000'],
            500 => ['background' => '#03A9F4', 'text' => '#000000'],
            600 => ['background' => '#039BE5', 'text' => '#FFFFFF'],
            700 => ['background' => '#0288D1', 'text' => '#FFFFFF'],
            800 => ['background' => '#0277BD', 'text' => '#FFFFFF'],
            900 => ['background' => '#01579B', 'text' => '#FFFFFF'],
        ],
        'cyan'        => [
            50  => ['background' => '#E0F7FA', 'text' => '#000000'],
            100 => ['background' => '#B2EBF2', 'text' => '#000000'],
            200 => ['background' => '#80DEEA', 'text' => '#000000'],
            300 => ['background' => '#4DD0E1', 'text' => '#000000'],
            400 => ['background' => '#26C6DA', 'text' => '#000000'],
            500 => ['background' => '#00BCD4', 'text' => '#000000'],
            600 => ['background' => '#00ACC1', 'text' => '#000000'],
            700 => ['background' => '#0097A7', 'text' => '#FFFFFF'],
            800 => ['background' => '#00838F', 'text' => '#FFFFFF'],
            900 => ['background' => '#006064', 'text' => '#FFFFFF'],
        ],
        'teal'        => [
            50  => ['background' => '#E0F2F1', 'text' => '#000000'],
            100 => ['background' => '#B2DFDB', 'text' => '#000000'],
            200 => ['background' => '#80CBC4', 'text' => '#000000'],
            300 => ['background' => '#4DB6AC', 'text' => '#000000'],
            400 => ['background' => '#26A69A', 'text' => '#000000'],
            500 => ['background' => '#009688', 'text' => '#FFFFFF'],
            600 => ['background' => '#00897B', 'text' => '#FFFFFF'],
            700 => ['background' => '#00796B', 'text' => '#FFFFFF'],
            800 => ['background' => '#00695C', 'text' => '#FFFFFF'],
            900 => ['background' => '#004D40', 'text' => '#FFFFFF'],
        ],
        'lime'        => [
            50  => ['background' => '#F9FBE7', 'text' => '#000000'],
            100 => ['background' => '#F0F4C3', 'text' => '#000000'],
            200 => ['background' => '#E6EE9C', 'text' => '#000000'],
            300 => ['background' => '#DCE775', 'text' => '#000000'],
            400 => ['background' => '#D4E157', 'text' => '#000000'],
            500 => ['background' => '#CDDC39', 'text' => '#000000'],
            600 => ['background' => '#C0CA33', 'text' => '#000000'],
            700 => ['background' => '#AFB42B', 'text' => '#000000'],
            800 => ['background' => '#9E9D24', 'text' => '#000000'],
            900 => ['background' => '#827717', 'text' => '#FFFFFF'],
        ],
        'yellow'      => [
            50  => ['background' => '#FFFDE7', 'text' => '#000000'],
            100 => ['background' => '#FFF9C4', 'text' => '#000000'],
            200 => ['background' => '#FFF59D', 'text' => '#000000'],
            300 => ['background' => '#FFF176', 'text' => '#000000'],
            400 => ['background' => '#FFEE58', 'text' => '#000000'],
            500 => ['background' => '#FFEB3B', 'text' => '#000000'],
            600 => ['background' => '#FDD835', 'text' => '#000000'],
            700 => ['background' => '#FBC02D', 'text' => '#000000'],
            800 => ['background' => '#F9A825', 'text' => '#000000'],
            900 => ['background' => '#F57F17', 'text' => '#000000'],
        ],
        'light green' => [
            50  => ['background' => '#F1F8E9', 'text' => '#000000'],
            100 => ['background' => '#DCEDC8', 'text' => '#000000'],
            200 => ['background' => '#C5E1A5', 'text' => '#000000'],
            300 => ['background' => '#AED581', 'text' => '#000000'],
            400 => ['background' => '#9CCC65', 'text' => '#000000'],
            500 => ['background' => '#8BC34A', 'text' => '#000000'],
            600 => ['background' => '#7CB342', 'text' => '#000000'],
            700 => ['background' => '#689F38', 'text' => '#FFFFFF'],
            800 => ['background' => '#558B2F', 'text' => '#FFFFFF'],
            900 => ['background' => '#33691E', 'text' => '#FFFFFF'],
        ],
        'amber'       => [
            50  => ['background' => '#FFF8E1', 'text' => '#000000'],
            100 => ['background' => '#FFECB3', 'text' => '#000000'],
            200 => ['background' => '#FFE082', 'text' => '#000000'],
            300 => ['background' => '#FFD54F', 'text' => '#000000'],
            400 => ['background' => '#FFCA28', 'text' => '#000000'],
            500 => ['background' => '#FFC107', 'text' => '#000000'],
            600 => ['background' => '#FFB300', 'text' => '#000000'],
            700 => ['background' => '#FFA000', 'text' => '#000000'],
            800 => ['background' => '#FF8F00', 'text' => '#000000'],
            900 => ['background' => '#FF6F00', 'text' => '#000000'],
        ],
        'deep orange' => [
            50  => ['background' => '#FBE9E7', 'text' => '#000000'],
            100 => ['background' => '#FFCCBC', 'text' => '#000000'],
            200 => ['background' => '#FFAB91', 'text' => '#000000'],
            300 => ['background' => '#FF8A65', 'text' => '#000000'],
            400 => ['background' => '#FF7043', 'text' => '#000000'],
            500 => ['background' => '#FF5722', 'text' => '#FFFFFF'],
            600 => ['background' => '#F4511E', 'text' => '#FFFFFF'],
            700 => ['background' => '#E64A19', 'text' => '#FFFFFF'],
            800 => ['background' => '#D84315', 'text' => '#FFFFFF'],
            900 => ['background' => '#BF360C', 'text' => '#FFFFFF'],
        ],
        'brown'       => [
            50  => ['background' => '#EFEBE9', 'text' => '#000000'],
            100 => ['background' => '#D7CCC8', 'text' => '#000000'],
            200 => ['background' => '#BCAAA4', 'text' => '#000000'],
            300 => ['background' => '#A1887F', 'text' => '#FFFFFF'],
            400 => ['background' => '#8D6E63', 'text' => '#FFFFFF'],
            500 => ['background' => '#795548', 'text' => '#FFFFFF'],
            600 => ['background' => '#6D4C41', 'text' => '#FFFFFF'],
            700 => ['background' => '#5D4037', 'text' => '#FFFFFF'],
            800 => ['background' => '#4E342E', 'text' => '#FFFFFF'],
            900 => ['background' => '#3E2723', 'text' => '#FFFFFF'],
        ],
        'grey'        => [
            50  => ['background' => '#FAFAFA', 'text' => '#000000'],
            100 => ['background' => '#F5F5F5', 'text' => '#000000'],
            200 => ['background' => '#EEEEEE', 'text' => '#000000'],
            300 => ['background' => '#E0E0E0', 'text' => '#000000'],
            400 => ['background' => '#BDBDBD', 'text' => '#000000'],
            500 => ['background' => '#9E9E9E', 'text' => '#000000'],
            600 => ['background' => '#757575', 'text' => '#FFFFFF'],
            700 => ['background' => '#616161', 'text' => '#FFFFFF'],
            800 => ['background' => '#424242', 'text' => '#FFFFFF'],
            900 => ['background' => '#212121', 'text' => '#FFFFFF'],
        ],
    ];

    /**
     * Get a palette list for a fixed spectrum
     *
     * @param  int $spectrum
     *
     * @return array
     */
    public function getAllColoursForSpectrum(int $spectrum = 400): array
    {
        $condensedArray = [];
        foreach ($this->palette as $colour => $spectra) {
            if (!array_key_exists($spectrum, $this->palette[$colour])) {
                throw new Error('Invalid spectrum');
            }
            $condensedArray[$colour] = $spectra[$spectrum];
        }

        return $condensedArray;
    }

    /**
     * Select a random colour from the standard palette,
     * optionally of specific spectrum value
     *
     * @param  int $spectrum
     *
     * @return array
     */
    public function getRandomColour(int $spectrum = null)
    {
        $colour = array_rand($this->palette);

        return $this->get($colour, $spectrum);
    }

    public function get($colour, $spectrum = null)
    {
        if (!array_key_exists($colour, $this->palette)) {
            throw new Error('Invalid colour');
        }

        if (!is_null($spectrum)) {
            if (!array_key_exists($spectrum, $this->palette[$colour])) {
                throw new Error('Invalid spectrum');
            }

            return $this->palette[$colour][$spectrum];
        } else {
            return $this->palette[$colour];
        }
    }

    public function getBackgroundForNumber(int $number, int $spectrum = 400)
    {
        return $this->getForNumber($number, $spectrum)['background'];
    }

    public function getTextForNumber(int $number, int $spectrum = 400)
    {
        return $this->getForNumber($number, $spectrum)['text'];
    }

    public function getForNumber(int $number, int $spectrum = 400)
    {
        $keys = array_keys($this->palette);

        $current = $number % count($keys);

        return $this->palette[$keys[$current]][$spectrum];
    }

    public static function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = [$r, $g, $b];

        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }

    public static function rgb2hex($rgb)
    {
        $hex = "#";
        $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

        return $hex; // returns the hex value including the number sign (#)
    }
}
