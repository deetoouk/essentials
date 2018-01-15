<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

/**
 * Class TextType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class TextType extends StringType
{
    /**
     * @var integer
     */
    public $max = 65535;
}
