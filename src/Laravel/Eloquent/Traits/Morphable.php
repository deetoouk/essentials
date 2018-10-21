<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Traits;

use DeeToo\Essentials\Laravel\Eloquent\Types\RelationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use DeeToo\Essentials\Laravel\Eloquent\Types\StringType;

/**
 * Class MorphedByCustomer
 *
 * @package DeeToo\Essentials\Laravel\Eloquent\Traits
 */
trait Morphable
{
    /**
     * @var boolean
     */
    public $morphable = true;

    /**
     * @throws \DeeToo\Essentials\Exceptions\Fatal
     */
    public function initMorphable()
    {
        $this->types['model_id']   = new RelationType(Model::class);
        $this->types['model_type'] = new StringType();
    }

    /**
     * @return mixed
     */
    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return boolean
     */
    public function assignedTo($model_type)
    {
        return $this->model_type === $model_type;
    }
}
