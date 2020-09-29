<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Traits;

use Illuminate\Support\Arr;

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
    protected array $errors = [];

    /**
     * @param $key
     */
    protected function clearError($key): void
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
    protected function recordError(string $key, string $message): void
    {
        $this->errors[$key] = $message;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function hasError(string $key): bool
    {
        return Arr::has($this->errors, $key);
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getError(string $key)
    {
        return Arr::get($this->errors, $key);
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
