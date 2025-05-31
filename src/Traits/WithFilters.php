<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Filters\{HandlesLivewireComponentFilters, HandlesPillsData, HasFilterGenericData, HasFilterMenu, HasFilterPills, HasFilterQueryString, HasFiltersCore, HasFiltersStatus, HasFiltersVisibility};
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Illuminate\Support\Arr;

trait WithFilters
{
    use HasFiltersStatus,
        HasFilterGenericData,
        HasFilterMenu,
        HandlesPillsData,
        HasFilterPills,
        HasFilterQueryString,
        HasFiltersVisibility,
        HasFiltersCore,
        HandlesLivewireComponentFilters;

    /**
     * Undocumented variable
     * 
     * Set in JS
     * 
     * @var array<mixed>
     */
    public array $appliedFilters = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $availableFilters = [];

    /**
     * Filter Configuration
     * 
     * Set in JS
     * 
     * @var array<mixed>
     */
    public array $filterConfiguration = ['filterCount' => null, 'filterLayout' => 'popover', 'filterPillsStatus' => true, 'filterSlideDownDefaultVisible' => false, 'filtersStatus' => true];

    /**
     * Undocumented variable
     *
     * @var Collection<int,Filter>|null
     */
    protected ?Collection $filterCollection;

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function filters(): array
    {
        return [];
    }

   /* public function updatedAvailableFilters2($val, $key)
    {
        $temp = Arr::undot([$key => $val]);
        $temp = Arr::first($temp);
        dd($temp);
        $this->appliedFilters = array_merge($this->appliedFilters, $temp);
        dd($this->appliedFilters);
    }*/
}
