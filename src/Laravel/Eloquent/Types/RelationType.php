<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Types;

use Illuminate\Database\Eloquent\Model;
use JTDSoft\Essentials\Exceptions\Fatal;

/**
 * Class RelationType
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Types
 */
class RelationType extends StringType
{
    public $relation;

    public $fieldType = null;

    /**
     * RelationType constructor.
     *
     * @param string|null $relation
     *
     * @throws Fatal
     */
    public function __construct(string $relation = null)
    {
        if ($relation) {
            $this->relation($relation);
        }
    }

    /**
     * @param string $relation
     *
     * @throws Fatal
     */
    public function relation(string $relation)
    {
        if (!is_subclass_of($relation, Model::class) && $relation !== Model::class) {
            throw new Fatal('relation value should be an instance of Model!');
        }

        $this->relation = $relation;
    }

    public function fieldType(Type $type)
    {
        $this->fieldType = $type;

        return $this;
    }

    public function castFromPrimitive($value)
    {
        if ($this->fieldType) {
            return $this->fieldType->castFromPrimitive($value);
        }

        return $value;
    }
}
