<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Traits;

use DeeToo\Essentials\Laravel\Eloquent\Types\StringType;

/**
 * Trait HasIdentifier
 * @package DeeToo\Essentials\Laravel\Eloquent\Traits
 */
trait HasIdentifier
{
    /**
     * @throws \DeeToo\Essentials\Exceptions\Error
     */
    public function initHasIdentifier()
    {
        $this->types['identifier'] = (new StringType())->nullable();
    }

    /**
     *
     */
    public static function bootHasIdentifier()
    {
        self::saving(function ($model) {
            if (!$model->identifier) {
                $model->generateIdentifier();
            }
        });
    }

    protected function generateIdentifier()
    {
        $this->identifier = str_random(40);
    }
}