<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Filters\{HandlesLivewireComponentFilters, HandlesPillsData, HasFilterGenericData, HasFilterMenu, HasFilterPills, HasFilterQueryString, HasFiltersCore, HasFiltersStatus, HasFiltersVisibility};
use Rappasoft\LaravelLivewireTables\Views\Filter;

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
    public array $filterComponents = [];

    /**
     * Undocumented variable
     * 
     * Set in Frontend
     *
     * @var array<mixed>
     */
    public array $appliedFilters = [];

    
    /**
     * Undocumented variable
     *
     * @var integer
     */
    #[Locked]
    public int $filterCount;

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
}
