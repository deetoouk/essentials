<?php namespace DeeToo\Essentials\Exceptions;

use Exception;
use Illuminate\Validation\Validator;

class Errors extends Exception
{
    protected $errors = [];

    public function __construct($errors)
    {
        if ($errors instanceof Validator) {
            $this->errors = $errors->getMessageBag()->getMessages();
        } else {
            $this->errors = $errors;
        }

        $this->message = json_encode($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
