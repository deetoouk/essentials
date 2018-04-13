<?php namespace DeeToo\Essentials\Laravel\Eloquent;

use Illuminate\Database\Eloquent\Collection as BaseCollection;
use Illuminate\Database\Eloquent\Model;

class Collection extends BaseCollection
{
    /**
     * Create a new collection.
     *
     * @param  mixed $items
     *
     * @return void
     */
    public function __construct($items = [])
    {
        if ($items) {
            $item = current($items);

            if ($item instanceof Model) {
                $items = $this->decorate($items);
            }
        }

        parent::__construct($items);
    }

    public function decorate(array $items)
    {
        $model = current($items)->newInstance();

        $toDecorate = [];

        foreach ($items as $key => $item) {
            if ($item->decorated) {
                continue;
            }

            if ($item->exists) {
                $toDecorate[$key] = $item;
            }
        }

        if ($toDecorate && !empty($model::$decorators)) {
            $chunks = array_chunk($toDecorate, 25);

            foreach ($chunks as $values) {
                $ids = array_unique(array_pluck($values, 'id'));

                foreach ($model::$decorators as $decorator) {
                    $values = (new $decorator)->handle($ids, $values);
                }

                foreach ($values as $key => $decorated) {
                    $decorated->decorated = true;
                    $toDecorate[$key]     = $decorated;
                }
            }
        }

        return $items;
    }
}
