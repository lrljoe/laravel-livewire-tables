<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits;

use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Filter;
use Rappasoft\LaravelLivewireTables\Collections\FilterCollection;

trait WithFilters
{
    use HasFiltersStatus,
        HasFilterGenericData,
        HasFilterSessionStorage,
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
    public array $filterConfiguration = ['filterCount' => null, 'filterLayout' => 'popover', 'filterPillsStatus' => true, 'filterSlideDownDefaultVisible' => false, 'filtersStatus' => true, 'visibilityStatus' => true];

    /**
     * Undocumented variable
     *
     * @var FilterCollection<int,Filter>|null
     */
    protected ?FilterCollection $filterCollection;

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function filters(): array
    {
        return [];
    }

    public function configuringWithFilters(): void
    {

        $this->setFilterLayout($this->getFilterLayout());
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
