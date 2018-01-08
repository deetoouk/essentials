<?php

use Illuminate\Support\Str;

if (!function_exists('class_uses_deep')) {
    /**
     * @param $class
     * @param bool $autoload
     *
     * @return array
     */
    function class_uses_deep($class, $autoload = true)
    {
        $traits = [];

        // Get traits of all parent classes
        do {
            $traits = array_merge(class_uses($class, $autoload), $traits);
        } while ($class = get_parent_class($class));

        // Get traits of all parent traits
        $traitsToSearch = $traits;
        while (!empty($traitsToSearch)) {
            $newTraits      = class_uses(array_pop($traitsToSearch), $autoload);
            $traits         = array_merge($newTraits, $traits);
            $traitsToSearch = array_merge($newTraits, $traitsToSearch);
        };

        foreach ($traits as $trait => $same) {
            $traits = array_merge(class_uses($trait, $autoload), $traits);
        }

        return array_unique($traits);
    }
}

if (!function_exists('translate')) {
/**
     * @param string $line
$app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php'
 *     * @param array $replace
     *
     * @return mixed|string
     */
    function translate(string $line, array $replace = [])
    {
        if(function_exists('__')) {
            return __($line, $replace);
        } else {
            foreach ($replace as $key => $value) {
                $line = str_replace(
                    [':' . $key, ':' . Str::upper($key), ':' . Str::ucfirst($key)],
                    [$value, Str::upper($value), Str::ucfirst($value)],
                    $line
                );
            }

            return $line;
        }
    }
}

if (!function_exists('format')) {
    /**
     * @return \JTDSoft\Essentials\Utilities\Formatter
     */
    function format()
    {
        return new \JTDSoft\Essentials\Utilities\Formatter();
    }
}

if (!function_exists('format')) {
    /**
     * @param null $message
     * @param null $title
     * @param null $time
     * @param null $is_html
     *
     * @return mixed
     */
    function flash($message = null, $title = null, $time = null, $is_html = null)
    {
        $flash = new \JTDSoft\Essentials\Utilities\Flash();

        if (func_num_args() == 0) {
            return $flash;
        }

        return $flash->success($message, $title, $time, $is_html);
    }
}

if (!function_exists('bark')) {
    /**
     * @param null $message
     * @param null $title
     *
     * @return \JTDSoft\Essentials\Utilities\Bark|string
     */
    function bark($message = null, $title = null)
    {
        $bark = new \JTDSoft\Essentials\Utilities\Bark();

        if (func_num_args() == 0) {
            return $bark;
        }

        return $bark->success($message, $title);
    }
}
