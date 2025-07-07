<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Configuration;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\Events\FilterApplied;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Filter;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\{BooleanFilter,MultiSelectDropdownFilter, MultiSelectFilter};

trait FilterConfiguration
{
    /**
     * Undocumented function
     *
     * @param string $filterKey
     * @param mixed $value
     * @return void
     */
    #[On('setFilter')]
    #[On('set-filter')]
    public function setFilter(string $filterKey, mixed $value): void
    {
        if(is_array($value) && empty($value))
        {
            $this->appliedFilters[$filterKey] = [];
            $this->availableFilters[$filterKey] = [];
            $this->dispatch('filter-was-set', tableName: $this->getTableName(), dataTableFingerprint: $this->getDataTableFingerprint(), filterKey: $filterKey, value: $value);
            
        }
        elseif((is_array($value) && !empty($value)) || !is_array($value))
        {
            $this->appliedFilters[$filterKey] =  $value;
            $this->callHook('filterSet', ['filter' => $filterKey, 'value' => $value]);
            $this->callTraitHook('filterSet', ['filter' => $filterKey, 'value' => $value]);
            if ($this->getEventStatusFilterApplied() && $filterKey != null && $value != null) {
                event(new FilterApplied($this->getTableName(), $filterKey, $value));
            }
            $this->dispatch('filter-was-set', tableName: $this->getTableName(), dataTableFingerprint: $this->getDataTableFingerprint(), filterKey: $filterKey, value: $value);
            $this->storeFilterValues();
        }
        

    }

    /**
     * Undocumented function
     *
     * @param string $tableName
     * @param string $filterKey
     * @param array<mixed> $values
     * @return void
     */
    #[On('livewireExternalArrayFilterUpdate')]
    public function setLivewireExternalArrayFilterValues(string $tableName, string $filterKey, array $values = [])
    {
        if($tableName == $this->getTableName() || $tableName == $this->getDataTableFingerprint())
        {
            $filter = $this->getFilterByKey($filterKey);
            $filter->options($values);
            $this->appliedFilters[$filterKey] = $values;
        }
    }



    #[On('clearFilters')]
    #[On('clear-filters')]
    public function setFilterDefaults(): void
    {
        foreach ($this->getFilters() as $filter) {
            if ($filter->isResetByClearButton()) {
                $this->resetFilter($filter);
            }
        }

    }

    /**
     * @param  mixed  $filter
     */
    public function resetFilter($filter): void
    {
        if (! $filter instanceof Filter) {
            $filter = $this->getFilterByKey($filter);
        }
        $this->callHook('filterReset', ['filter' => $filter->getKey()]);
        $this->callTraitHook('filterReset', ['filter' => $filter->getKey()]);
        $this->setFilter($filter->getKey(), $filter->getDefaultValue());
        if(array_key_exists($filter->getKey(), $this->availableFilters))
        {
            $this->availableFilters[$filter->getKey()] = [];
        }

    }

    public function selectAllFilterOptions(string $filterKey): void
    {
        $filter = $this->getFilterByKey($filterKey);

        if (! $filter instanceof MultiSelectFilter && ! $filter instanceof MultiSelectDropdownFilter) {
            return;
        }

        if (count($this->getAppliedFilterWithValue($filterKey) ?? []) === count($filter->getOptions())) {
            $this->resetFilter($filterKey);

            return;
        }

        $this->setFilter($filterKey, array_keys($filter->getOptions()));
    }

    /**
     * Undocumented function
     *
     * @return Builder<\Illuminate\Database\Eloquent\Model>
     */
    public function applyFilters(): Builder
    {
        if ($this->filtersAreEnabled() && $this->hasFilters() && $this->hasAppliedFiltersWithValues()) {
            $appliedFilters = $this->getAppliedFiltersWithValues();

            foreach ($this->getFilters() as $filter) {
                $filterKey = $filter->getKey();
                if(array_key_exists($filterKey, $appliedFilters) && !is_null($appliedFilters[$filterKey]) && $filter->hasFilterCallback())
                {
                    $value = method_exists($filter, 'validate') ? $filter->validate($appliedFilters[$filterKey]) : $appliedFilters[$filterKey];

                    // If validate returns false, and it is not a BooleanFilter - do not apply the filter.
                    if (! ($filter instanceof BooleanFilter) && ($value === false)) {
                        $this->resetFilter($filterKey);

                        continue;
                    }
                    $this->callHook('filterApplying', ['filter' => $filter->getKey(), 'value' => $value]);
                    $this->callTraitHook('filterApplying', ['filter' => $filter->getKey(), 'value' => $value]);

                    ($filter->getFilterCallback())($this->getBuilder(), $value);
                }
            }
            $this->storeFilterValues();
        }


        return $this->getBuilder();
    }

    /**
     * Undocumented function
     *
     * @param string|array<mixed>|null $value
     * @param string $filterName
     * @return void
     */
    public function updatedAppliedFilters(string|array|null $value, string $filterName): void
    {
                \Illuminate\Support\Facades\Log::error("updatedAppliedFilters");

        // Clear bulk actions on filter - if enabled
        if ($this->getClearSelectedOnFilter()) {
            $this->clearSelected();
            $this->setSelectAllDisabled();
        }
    }

    /**
     * Undocumented function
     *
     * @param string|array<mixed>|null $value
     * @param string $filterName
     * @return void
     */
    public function updatedTestAppliedFilters(string|array|null $value, string $filterName): void
    {
                \Illuminate\Support\Facades\Log::error("updatedTestAppliedFilters");


        $this->resetComputedPage();

        // Clear bulk actions on filter - if enabled
        if ($this->getClearSelectedOnFilter()) {
            $this->clearSelected();
            $this->setSelectAllDisabled();
        }

        // Clear filters on empty value
        $filter = $this->getFilterByKey($filterName);

        if ($filter && $filter->isEmpty($value)) {
            $this->callHook('filterRemoved', ['filter' => $filter->getKey()]);
            $this->callTraitHook('filterRemoved', ['filter' => $filter->getKey()]);

            $this->resetFilter($filterName);
        } elseif ($filter) {
            $this->callHook('filterUpdated', ['filter' => $filter->getKey(), 'value' => $value]);
            $this->callTraitHook('filterUpdated', ['filter' => $filter->getKey(), 'value' => $value]);
            if ($this->getEventStatusFilterApplied() && $filter->getKey() != null && $value != null) {
                event(new FilterApplied($this->getTableName(), $filter->getKey(), $value));
            }
            $this->dispatch('filter-was-set', tableName: $this->getTableName(), dataTableFingerprint: $this->getDataTableFingerprint(), filterKey: $filter->getKey(), value: $value);

        }

    }
}
