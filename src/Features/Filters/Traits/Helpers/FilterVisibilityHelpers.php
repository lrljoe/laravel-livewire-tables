<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Helpers;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Filter;

trait FilterVisibilityHelpers
{
    public function getFiltersVisibilityStatus(): bool
    {
        return $this->filterConfiguration['visibilityStatus'];
        
    }

    public function filtersVisibilityIsEnabled(): bool
    {
        return $this->getFiltersVisibilityStatus() === true;
    }

    public function filtersVisibilityIsDisabled(): bool
    {
        return $this->getFiltersVisibilityStatus() === false;
    }

    public function hasVisibleFilters(): bool
    {
        return $this->getFilters()
            ->reject(fn (Filter $filter) => $filter->isHiddenFromMenus())
            ->count() > 0;
    }

    public function showFiltersButton(): bool
    {
        return $this->filtersAreEnabled() && $this->filtersVisibilityIsEnabled() && $this->hasVisibleFilters();
    }

    /**
     * Get whether filter has a configured slide down row.
     *
     * @return Collection<int,Filter>
     */
    public function getVisibleFilters(): Collection
    {
        return $this->getFilters()->reject(fn (Filter $filter) => $filter->isHiddenFromMenus())
        ->each(function (Filter $filter) {
            $filter->setGenericDisplayData($this->getFilterGenericData());
        });
    }
}
