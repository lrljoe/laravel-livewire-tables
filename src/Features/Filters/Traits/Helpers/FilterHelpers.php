<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Helpers;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Filter;
use Rappasoft\LaravelLivewireTables\Collections\FilterCollection;

trait FilterHelpers
{
    /**
     * Undocumented function
     *
     * @return boolean
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
     *
     * @return integer
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
     *
     * @param string $key
     * @return mixed
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
     *
     * @return boolean
     */
    public function hasAppliedFiltersWithValues(): bool
    {
        return count($this->getAppliedFiltersWithValues()) > 0;
    }

    /**
     * Undocumented function
     *
     * @return boolean
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
     *
     * @return integer
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
     *
     * @param string $filterKey
     * @return mixed
     */
    public function getAppliedFilterWithValue(string $filterKey): mixed
    {
        return $this->getAppliedFiltersWithValues()[$filterKey] ?? null;
    }

    /**
     * Undocumented function
     *
     * @return integer
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
