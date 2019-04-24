<?php namespace DeeToo\Essentials\Exceptions;

use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Error
 *
 * @package DeeToo\Essentials\Exceptions
 */
class Error extends Exception
{
    /**
     * Error constructor.
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
            "message" => "The given data was invalid.",
            "error"   => $this->message,
            "code"    => $this->code,
        ], 422);
    }
}
