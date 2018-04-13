<?php namespace DeeToo\Essentials\Laravel\Eloquent\Traits;

/**
 * Class ErrorManagement
 *
 * @package DeeToo\Essentials\Laravel\Eloquent\Traits
 */
trait ErrorManagement
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @param $key
     */
    protected function clearError($key)
    {
        if (isset($this->errors[$key])) {
            unset($this->errors[$key]);
        }

        if (is_null($this->errors)) {
            $this->errors = [];
        }
    }

    /**
     * @param $key
     * @param $message
     */
    protected function recordError($key, $message)
    {
        $this->errors[$key] = $message;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function hasError($key)
    {
        return array_has($this->errors, $key);
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getError($key)
    {
        return array_get($this->errors, $key);
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return !empty($this->errors);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
