<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Core\{HasCustomAttributes, HasLocalisations};
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasTheme;
use Rappasoft\LaravelLivewireTables\Traits\Styling\{HasCoreStyling, HasHeaderStyling};
use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\WithFilters;
use Rappasoft\LaravelLivewireTables\Features\Columns\Core\{WithColumns,WithColumnsCollapsing,WithColumnSelect};
use Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\WithBulkActions;


trait HasAllTraits
{
    // Note Specific Order Below!
    use WithTableHooks;
    use HasLocalisations,
        WithLoadingPlaceholder,
        HasTheme,
        WithFilters;
    use WithQuery,
        ComponentUtilities,
        WithActions,
        WithData,
        WithQueryString,
        WithColumns,
        WithSorting,
        WithSearch,
        WithPagination;
    use WithBulkActions,
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
    use HasHeaderStyling,
        HasCoreStyling;

}
