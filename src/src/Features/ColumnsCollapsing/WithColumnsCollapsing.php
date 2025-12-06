<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing;

use Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing\Concerns\HandlesColumnCollapsingStatus;
use Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing\Configuration\ColumnCollapsingConfiguration;
use Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing\Helpers\ColumnCollapsingHelpers;
use Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing\Styling\HasColumnCollapsingStyling;

trait WithColumnsCollapsing
{
    use HandlesColumnCollapsingStatus,
        ColumnCollapsingConfiguration,
        ColumnCollapsingHelpers,
        HasColumnCollapsingStyling;

    /**
     * Determines if any Columns have Collapse On All
     */
    protected ?bool $shouldAlwaysCollapse;

    /**
     * Determines if any Columns have Collapse On Mobile
     */
    protected ?bool $shouldMobileCollapse;

    /**
     * Determines if any Columns have Collapse On Tablet
     */
    protected ?bool $shouldTabletCollapse;
}
