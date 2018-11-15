<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Traits;

use DeeToo\Essentials\Laravel\Eloquent\Types\TextType;

/**
 * Trait HasDescription
 * @package DeeToo\Essentials\Laravel\Eloquent\Traits
 */
trait HasDescription
{
    /**
     * @throws \DeeToo\Essentials\Exceptions\Error
     */
    public function initHasDescription()
    {
        $this->types['description'] = (new TextType())->nullable();
    }
}