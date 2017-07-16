<?php

namespace JordanDobrev\Essentials\Laravel\Eloquent\Types;

use Illuminate\Database\Eloquent\Model;
use JordanDobrev\Essentials\Exceptions\Error;
use JordanDobrev\Essentials\Exceptions\Fatal;

/**
 * Class RelationType
 *
 * @package JordanDobrev\Essentials\Laravel\Eloquent\Types
 */
class RelationType extends Type
{
    public $relation;

    /**
     * RelationType constructor.
     *
     * @param string|null $relation
     */
    public function __construct(string $relation = null)
    {
        if ($relation) {
            $this->relation($relation);
        }
    }

    public function relation(string $relation)
    {
        if (!($relation instanceof Model)) {
            throw new Fatal('relation value should be an instance of Model!');
        }

        $this->relation = $relation;
    }

    function validate($attribute, $value)
    {
        if (!($value instanceof $this->relation)) {
            throw new Error(':attribute must be an instance of ' . $this->relation);
        }

        $exists = (new $this->relation)->whereId($value)->exists();

        if (!$exists) {
            throw new Error(':attribute relation #:value does not exist', compact('attribute', 'value'));
        }
    }
}
