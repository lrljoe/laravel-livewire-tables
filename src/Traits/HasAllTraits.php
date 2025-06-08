<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Core\{HasCustomAttributes, HasLocalisations};
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasTheme;
use Rappasoft\LaravelLivewireTables\Traits\Styling\{HasCoreStyling};
use Rappasoft\LaravelLivewireTables\Features\Actions\Core\WithActions;
use Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\WithBulkActions;
use Rappasoft\LaravelLivewireTables\Features\Columns\Core\{WithColumns,WithColumnsCollapsing,WithColumnSelect};
use Rappasoft\LaravelLivewireTables\Features\ConfigurableAreas\WithConfigurableAreas;
use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\WithFilters;
use Rappasoft\LaravelLivewireTables\Features\Footer\WithFooter;
use Rappasoft\LaravelLivewireTables\Features\Pagination\WithPagination;
use Rappasoft\LaravelLivewireTables\Features\Reordering\WithReordering;
use Rappasoft\LaravelLivewireTables\Features\Search\WithSearch;
use Rappasoft\LaravelLivewireTables\Features\SecondaryHeader\WithSecondaryHeader;
use Rappasoft\LaravelLivewireTables\Features\Sorting\WithSorting;
use Rappasoft\LaravelLivewireTables\Features\Tools\WithTools;

trait HasAllTraits
{
    // Note Specific Order Below!
    use WithTableHooks,
        HasLocalisations,
        WithLoadingPlaceholder,
        HasTheme,
        WithFilters,
        WithQuery,
        ComponentUtilities,
        WithActions,
        WithData,
        WithQueryString,
        WithColumns,
        WithSorting,
        WithSearch,
        WithPagination,
        WithBulkActions,
        HasCustomAttributes,
        WithColumnsCollapsing,
        WithColumnSelect,
        WithConfigurableAreas,
        WithCustomisations,
        WithDebugging,
        WithEvents,
        WithFooter,
        WithRefresh,
        WithReordering,
        WithSecondaryHeader,
        WithSessionStorage,
        WithTableAttributes,
        WithTools;

}
