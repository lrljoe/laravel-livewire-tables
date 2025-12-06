<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing;

use Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing\Configuration\ColumnCollapsingConfiguration;
use Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing\Helpers\ColumnCollapsingHelpers;
use Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing\Styling\HasColumnCollapsingStyling;
use Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing\Concerns\HandlesColumnCollapsingStatus;

trait WithColumnsCollapsing
{
    use HandlesColumnCollapsingStatus,
        ColumnCollapsingConfiguration,
        ColumnCollapsingHelpers,
        HasColumnCollapsingStyling;

    /**
     * Determines if any Columns have Collapse On All
     *
     * @var boolean|null
     */
    protected ?bool $shouldAlwaysCollapse;

    /**
     * Determines if any Columns have Collapse On Mobile
     *
     * @var boolean|null
     */
    protected ?bool $shouldMobileCollapse;

    /**
     * Determines if any Columns have Collapse On Tablet
     *
     * @var boolean|null
     */
    protected ?bool $shouldTabletCollapse;
}
