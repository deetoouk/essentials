<?php namespace JTDSoft\Essentials\Laravel\Eloquent\Traits;

use JTDSoft\Essentials\Laravel\Eloquent\Types\UuidType;

/**
 * Class Uuid
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Traits
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
                    $model->id = $model->generateUuid();
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
     * @return bool|string
     */
    public function generateUuid()
    {
        $uuid = false;

        while (true) {
            $uuid = sprintf(
                '%04x%04x-%04x-%04x-%04x-%04x%04x%04s',
                // 32 bits for "time_low"
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                // 16 bits for "time_mid"
                mt_rand(0, 0xffff),
                // 16 bits for "time_hi_and_version",
                // four most significant bits holds version number 4
                mt_rand(0, 0x0fff) | 0x4000,
                // 16 bits, 8 bits for "clk_seq_hi_res",
                // 8 bits for "clk_seq_low",
                // two most significant bits holds zero and one for variant DCE1.1
                mt_rand(0, 0x3fff) | 0x8000,
                // 48 bits for "node"
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                strtolower(config('replication.node')) //actual node name from env config
            );

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
