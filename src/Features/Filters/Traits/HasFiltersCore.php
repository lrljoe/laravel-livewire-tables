<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits;

use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Configuration\FilterConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Helpers\FilterHelpers;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\DateRangeFilter;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\LivewireComponentArrayFilter;

trait HasFiltersCore
{
    use FilterConfiguration,
        FilterHelpers;

    /**
     * Sets Filter Default Values
     */
    public function mountHasFiltersCore(): void
    {
        $this->restoreFilterValues();

        foreach ($this->getFilters() as $filter) {
            if (! isset($this->appliedFilters[$filter->getKey()])) {
                if ($filter->hasFilterDefaultValue()) {
                    $this->setFilter($filter->getKey(), method_exists($filter, 'getFilterDefaultValue') ? $filter->getFilterDefaultValue() : null);
                } else {
                    $this->resetFilter($filter);
                }
            } else {
                $this->setFilter($filter->getKey(), $this->appliedFilters[$filter->getKey()]);
            }
        }
    }

    public function bootedHasFiltersCore(): void
    {
        $this->setBuilder($this->builder());

        foreach ($this->getFilters() as $filter) {
            $filterKey = $filter->getKey();

            if ($filter instanceof LivewireComponentArrayFilter && ! array_key_exists($filterKey, $this->availableFilters)) {
                $this->availableFilters[$filterKey] = $this->appliedFilters[$filterKey] ?? [];
            }
        }
    }
}
