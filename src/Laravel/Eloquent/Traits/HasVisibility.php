<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Traits;

use DeeToo\Essentials\Laravel\Eloquent\Types\BooleanType;

/**
 * Trait HasVisibility
 * @package DeeToo\Essentials\Laravel\Eloquent\Traits
 */
trait HasVisibility
{
    /**
     * @throws \DeeToo\Essentials\Exceptions\Error
     */
    public function initHasVisibility()
    {
        $this->types['visible'] = (new BooleanType())->default(true);
    }
}