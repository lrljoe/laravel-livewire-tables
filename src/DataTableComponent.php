<?php

namespace Rappasoft\LaravelLivewireTables;

use Livewire\Attributes\{On, Renderless};
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Traits\{ComponentUtilities, WithCustomisations, WithData, WithDebugging, WithEvents, WithQuery, WithQueryString, WithRefresh, WithTableHooks, WithTableAttributes};
use Rappasoft\LaravelLivewireTables\Traits\Core\{HasCustomAttributes, HasLocalisations};
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasTheme;
use Rappasoft\LaravelLivewireTables\Traits\Styling\{HasCoreStyling};
use Rappasoft\LaravelLivewireTables\Features\Actions\Core\WithActions;
use Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\WithBulkActions;
use Rappasoft\LaravelLivewireTables\Features\Columns\Core\WithColumns;
use Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing\WithColumnsCollapsing;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\WithColumnSelect;
use Rappasoft\LaravelLivewireTables\Features\ConfigurableAreas\WithConfigurableAreas;
use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\WithFilters;
use Rappasoft\LaravelLivewireTables\Features\Footer\WithFooter;
use Rappasoft\LaravelLivewireTables\Features\Pagination\WithPagination;
use Rappasoft\LaravelLivewireTables\Features\Reordering\WithReordering;
use Rappasoft\LaravelLivewireTables\Features\SecondaryHeader\WithSecondaryHeader;
use Rappasoft\LaravelLivewireTables\Features\Search\WithSearch;
use Rappasoft\LaravelLivewireTables\Features\SessionStorage\WithSessionStorage;
use Rappasoft\LaravelLivewireTables\Features\Sorting\WithSorting;
use Rappasoft\LaravelLivewireTables\Features\Tools\WithTools;
use Rappasoft\LaravelLivewireTables\Features\LoadingPlaceholder\WithLoadingPlaceholder;
use Rappasoft\LaravelLivewireTables\Traits\WithFeatureDetection;

abstract class DataTableComponent extends Component
{

    use WithFeatureDetection,
        ComponentUtilities,
        WithQueryString,
        WithTableHooks,
        WithSessionStorage,
        HasLocalisations,
        WithLoadingPlaceholder,
        WithFilters,
        HasTheme,
        WithQuery,
        WithActions,
        WithData,
        WithColumns,
        WithColumnsCollapsing,
        WithColumnSelect,
        WithSearch,
        WithSorting,
        WithPagination,
        WithBulkActions,
        HasCustomAttributes,
        WithConfigurableAreas,
        WithCustomisations,
        WithDebugging,
        WithEvents,
        WithFooter,
        WithRefresh,
        WithReordering,
        WithSecondaryHeader,
        WithTableAttributes,
        WithTools;


    /**
     * Runs on every request, immediately after the component is instantiated, but before any other lifecycle methods are called
     * Called when refreshDatatable is called as an event
     */
    #[On('refreshDatatable')]
    public function refreshDatatable(): void
    {
        $this->boot();
    }

    public function boot(): void
    {
        //
    }

    /**
     * Runs on every request, after the component is mounted or hydrated, but before any update methods are called
     */
    public function booted(): void {}

    public function render(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire-tables::datatable');
    }
}
