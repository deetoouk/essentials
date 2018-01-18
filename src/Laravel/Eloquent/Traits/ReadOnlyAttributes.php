<?php namespace JTDSoft\Essentials\Laravel\Eloquent\Traits;

/**
 * Class ReadOnlyAttributes
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Traits
 */
trait ReadOnlyAttributes
{
    /**
     * Indicated which attributes are real only.
     * Blocks from writing unless model is unguarded
     *
     * @var array
     */
    protected $readOnly = [];

    /**
     * Determine if the given key is read only.
     *
     * @param  string $key
     *
     * @return bool
     */
    public function isReadOnly($key)
    {
        return in_array($key, $this->getReadOnly());
    }

    /**
     * Returns all read only attributes
     *
     * @return array
     */
    public function getReadOnly()
    {
        return $this->readOnly;
    }
}
