<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class MorphedByCustomer
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Traits
 */
trait Morphable
{
    /**
     * @var boolean
     */
    public $morphable = true;

    public function initMorphable()
    {
        $this->types['model_id']   = Model::class;
        $this->types['model_type'] = 'string';
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
