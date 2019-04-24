<?php namespace DeeToo\Essentials\Exceptions;

use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Errors
 *
 * @package DeeToo\Essentials\Exceptions
 */
class Errors extends Exception
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * Errors constructor.
     *
     * @param $errors
     */
    public function __construct($errors)
    {
        if ($errors instanceof Validator) {
            $this->errors = $errors->getMessageBag()->getMessages();
        } else {
            $this->errors = $errors;
        }

        $this->message = json_encode($this->errors);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return ResponseFactory|Response
     */
    public function render()
    {
        return response([
            "message" => "The given data was invalid.",
            "errors"  => $this->errors,
            "code"    => $this->code,
        ], 422);
    }
}
