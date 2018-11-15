<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Traits;

use DeeToo\Essentials\Laravel\Eloquent\Types\StringType;

/**
 * Trait HasName
 * @package DeeToo\Essentials\Laravel\Eloquent\Traits
 */
trait HasName
{
    /**
     */
    public function initHasName()
    {
        $this->types['name'] = (new StringType());
    }
}
