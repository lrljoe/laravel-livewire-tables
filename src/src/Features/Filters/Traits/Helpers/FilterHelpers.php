<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Helpers;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Collections\FilterCollection;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Filter;

trait FilterHelpers
{
    /**
     * Undocumented function
     */
    public function hasFilters(): bool
    {
        return $this->getFiltersCount() > 0;
    }

    /**
     * Undocumented function
     *
     * @return FilterCollection<int,Filter>
     */
    public function getFilters(): FilterCollection
    {
        if (! isset($this->filterCollection)) {
            $this->filterCollection = new FilterCollection($this->filters());
        }

        return $this->filterCollection;
    }

    /**
     * Undocumented function
     */
    public function getFiltersCount(): int
    {
        if (! isset($this->filterConfiguration['filterCount'])) {
            $this->filterConfiguration['filterCount'] = $this->getFilters()->count();
        }

        return $this->filterConfiguration['filterCount'];
    }

    /**
     * Undocumented function
     */
    public function getFilterByKey(string $key): mixed
    {
        return $this->getFilters()->first(function ($filter) use ($key) {
            return $filter->getKey() === $key;
        });
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getAppliedFilters(): array
    {
        $validFilterKeys = $this->getFilters()
            ->map(fn (Filter $filter) => $filter->getKey())
            ->toArray();

        return new FilterCollection($this->appliedFilters ?? [])
            ->filter(fn ($value, $key) => in_array($key, $validFilterKeys, true))
            ->toArray();
    }

    /**
     * Undocumented function
     */
    public function hasAppliedFiltersWithValues(): bool
    {
        return count($this->getAppliedFiltersWithValues()) > 0;
    }

    /**
     * Undocumented function
     */
    public function hasAppliedVisibleFiltersWithValuesThatCanBeCleared(): bool
    {
        return new FilterCollection($this->getAppliedFiltersWithValues())
            ->map(fn ($_item, $key) => $this->getFilterByKey($key))
            ->reject(fn (Filter $filter) => $filter->isHiddenFromMenus() && ! $filter->isResetByClearButton())
            ->count() > 0;
    }

    /**
     * Undocumented function
     */
    public function getFilterBadgeCount(): int
    {
        return new FilterCollection($this->getAppliedFiltersWithValues())
            ->map(fn ($_item, $key) => $this->getFilterByKey($key))
            ->reject(fn (Filter $filter) => $filter->isHiddenFromFilterCount())
            ->count();
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getAppliedFiltersWithValues(): array
    {
        return $this->appliedFilters = array_filter($this->getAppliedFilters(), function ($item, $key) {
            $filter = $this->getFilterByKey($key);
            $item = (! is_null($item) && ! $filter->isEmpty($item)) ? $filter->validate($item) : $item;

            return ! $filter->isEmpty($item) && (is_array($item) ? count($item) : $item !== null);
        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * Undocumented function
     */
    public function getAppliedFilterWithValue(string $filterKey): mixed
    {
        return $this->getAppliedFiltersWithValues()[$filterKey] ?? null;
    }

    /**
     * Undocumented function
     */
    public function getAppliedFiltersWithValuesCount(): int
    {
        return count($this->getAppliedFiltersWithValues());
    }

    /**
     * Undocumented function
     *
     * @return FilterCollection<int,Filter>
     */
    public function getAppliedFiltersCollection(): FilterCollection
    {
        $validFilterKeys = $this->getFilters()
            ->map(fn (Filter $filter) => $filter->getKey())
            ->toArray();

        return new FilterCollection($this->appliedFilters ?? [])
            ->filter(fn ($value, $key) => in_array($key, $validFilterKeys, true));
    }
}
