<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Types;

/**
 * Class TextType
 *
 * @package DeeToo\Essentials\Laravel\Eloquent\Types
 */
class TextType extends StringType
{
    /**
     * @var integer
     */
    public $max = 65535;
}
