<?php

namespace JTDSoft\Essentials\Laravel\Eloquent\Traits;

use JTDSoft\Essentials\Services\Filter;
use ReflectionClass;

/**
 * Class ModelRelationships
 *
 * @package JTDSoft\Essentials\Laravel\Eloquent\Traits
 */
trait ModelFilters
{
    /**
     * @var array
     */
    protected $autocomplete = [];

    /**
     * @var array
     */
    protected $search_terms = [];

    /**
     * @return array
     */
    public function getAutocomplete(): array
    {
        return $this->autocomplete;
    }

    /**
     * @return array
     */
    public function getSearchTerms(): array
    {
        return $this->search_terms;
    }

    /**
     * @param            $query
     * @param array|null $filters
     *
     * @return $this|Base|null
     */
    public function scopeFilters($query, array $filters = null)
    {
        if (!$filters && !is_array($filters)) {
            return null;
        }

        $reflection = new ReflectionClass($this);

        $section = $reflection->getShortName();

        $filter = new Filter();

        $filter->set($filters, $section);

        return $this->scopeFilter($query, $filter);
    }

    /**
     * @param        $query
     * @param Filter $group
     *
     * @return $this|void
     */
    public function scopeFilter($query, Filter $group)
    {
        if (!$group) {
            return $query;
        }

        //Add filter as group to avoid
        //OR clauses elimination of
        //scope clauses and permission filters
        $filter = new Filter();
        $filter->addGroup($group);

        $filter->apply($query);

        return $query;
    }
}
