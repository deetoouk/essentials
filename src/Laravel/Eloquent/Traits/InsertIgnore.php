<?php

namespace DeeToo\Essentials\Laravel\Eloquent\Traits;

use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Arr;
use DeeToo\Essentials\Exceptions\Fatal;

trait InsertIgnore
{
    /**
     * performs an 'insert ignore' query with the data
     *
     * @param array $options
     *
     * @return bool t/f for success/failure
     */
    public function insertIgnore(array $options = [])
    {
        $query = $this->newQueryWithoutScopes();

        // If the "saving" event returns false we'll bail out of the save and return
        // false, indicating that the save failed. This provides a chance for any
        // listeners to cancel save operations if validations fail or whatever.
        if ($this->fireModelEvent('saving') === false) {
            return false;
        }

        $saved = $this->performInsertIgnore($query);

        if ($saved) {
            $this->finishSave($options);
        }

        return $saved;
    }

    /**
     * Perform a model insert operation.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     *
     * @return bool
     * @throws Fatal
     */
    protected function performInsertIgnore(Builder $query)
    {
        if ($this->fireModelEvent('creating') === false) {
            return false;
        }

        // First we'll need to create a fresh query instance and touch the creation and
        // update timestamps on this model, which are maintained by us for developer
        // convenience. After, we will just continue saving these model instances.
        if ($this->usesTimestamps()) {
            $this->updateTimestamps();
        }

        $attributes = $this->attributes;

        if (empty($attributes)) {
            throw new Fatal('Cannot perform insert into without attributes!');
        }

        // Finally, we will run this query against the database connection and return
        // the results. We will need to also flatten these bindings before running
        // the query so they are all in one huge, flattened array for execution.
        $query = $this->getConnection()->getQueryGrammar()->compileInsert($query->getQuery(), $attributes);

        $query = str_replace_first('insert into', 'insert ignore into', $query);

        $this->getConnection()->statement(
            $query,
            array_values(array_filter(Arr::flatten($attributes, 1), function ($binding) {
                return !$binding instanceof Expression;
            }))
        );

        $id = $this->getConnection()->getPdo()->lastInsertId();

        if (!$id) {
            return false;
        }

        $this->{$this->primaryKey} = $id;

        // We will go ahead and set the exists property to true, so that it is set when
        // the created event is fired, just in case the developer tries to update it
        // during the event. This will allow them to do so and run an update here.
        $this->exists = true;

        $this->wasRecentlyCreated = true;

        $this->fireModelEvent('created', false);

        return true;
    }
}
