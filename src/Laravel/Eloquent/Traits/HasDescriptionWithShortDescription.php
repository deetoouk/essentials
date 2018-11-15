<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Traits;

use DeeToo\Essentials\Laravel\Eloquent\Types\TextType;

/**
 * Trait HasDescription
 *
 * @package DeeToo\Essentials\Laravel\Eloquent\Traits
 */
trait HasDescriptionWithShortDescription
{
    use HasDescription;

    /**
     * @throws \DeeToo\Essentials\Exceptions\Error
     */
    public function initHasDescriptionWithShortDescription()
    {
        $this->types['description_short'] = (new TextType())->nullable();
    }
}
