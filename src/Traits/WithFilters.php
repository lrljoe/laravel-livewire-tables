<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Filters\{HandlesLivewireComponentFilters, HandlesPillsData, HasFilterGenericData, HasFilterMenu, HasFilterPills, HasFilterQueryString, HasFiltersCore, HasFiltersStatus, HasFiltersVisibility};

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
     * Set in JS
     * @var array<mixed>
     */
    public array $filterComponents = [];

    /**
     * Set in Frontend
     *
     * @var array<mixed>
     */
    public array $appliedFilters = [];

    #[Locked]
    public int $filterCount;

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
