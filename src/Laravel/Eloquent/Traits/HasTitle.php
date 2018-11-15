<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Traits;

use DeeToo\Essentials\Laravel\Eloquent\Types\StringType;

/**
 * Trait HasTitle
 * @package DeeToo\Essentials\Laravel\Eloquent\Traits
 */
trait HasTitle
{
    /**
     */
    public function initHasTitle()
    {
        $this->types['title'] = (new StringType());
    }
}
