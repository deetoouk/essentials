<?php namespace DeeToo\Essentials\Exceptions;

use Exception;

class Fatal extends Exception
{
    public function __construct($message = "", ...$params)
    {
        $code     = 0;
        $previous = null;

        $translate_parameters = [];

        if (!empty($params)) {
            if (is_array($params[0])) {
                $translate_parameters = array_shift($params);
            }

            $code     = $params[0] ?? $code;
            $previous = $params[1] ?? $previous;
        }

        $message = __($message, $translate_parameters);

        parent::__construct($message, $code, $previous);
    }
}
