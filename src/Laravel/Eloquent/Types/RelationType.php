<?php

namespace JordanDobrev\Essentials\Laravel\Eloquent\Types;

use Illuminate\Database\Eloquent\Model;
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
}
