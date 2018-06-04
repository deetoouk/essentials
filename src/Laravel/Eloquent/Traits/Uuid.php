<?php namespace DeeToo\Essentials\Laravel\Eloquent\Traits;

use DeeToo\Essentials\Laravel\Eloquent\Types\UuidType;

/**
 * Class Uuid
 *
 * @package DeeToo\Essentials\Laravel\Eloquent\Traits
 */
trait Uuid
{
    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootUuid()
    {
        static::creating(
            function ($model) {
                if (!$model->id) {
                    $model->id = $model->generateUniqueUuid();
                }
            }
        );
    }

    /**
     *
     */
    public function initUuid()
    {
        $this->incrementing = false;
        $this->types['id']  = new UuidType();
    }

    /**
     * @return string
     */
    public function generateUuid(): string
    {
        return \Ramsey\Uuid\Uuid::uuid1(config('replication.node'));
    }

    /**
     * @return bool|string
     */
    public function generateUniqueUuid()
    {
        $uuid = false;

        while (true) {
            $uuid = $this->generateUuid();

            $exists = (new static)
                ->newQueryWithoutScopes()
                ->whereId($uuid)
                ->exists();

            if (!$exists) {
                break;
            }
        }

        return $uuid;
    }
}
