<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use Illuminate\Database\Eloquent\Model;
use JTDSoft\Essentials\Exceptions\Error;
use JTDSoft\Essentials\Exceptions\Fatal;

/**
 * Class RelationType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
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
        if (!is_subclass_of($relation, Model::class) && $relation !== Model::class) {
            throw new Fatal('relation value should be an instance of Model!');
        }

        $this->relation = $relation;
    }

    public function validate($attribute, $value)
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
