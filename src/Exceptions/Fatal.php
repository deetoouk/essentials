<?php namespace DeeToo\Essentials\Exceptions;

use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Fatal
 *
 * @package DeeToo\Essentials\Exceptions
 */
class Fatal extends Exception
{
    /**
     * Fatal constructor.
     *
     * @param string $message
     * @param mixed ...$params
     */
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

    /**
     * @return ResponseFactory|Response
     */
    public function render()
    {
        return response([
            "message" => "Server Error.",
            "error"   => $this->message,
            "code"    => $this->code,
        ], 500);
    }
}
