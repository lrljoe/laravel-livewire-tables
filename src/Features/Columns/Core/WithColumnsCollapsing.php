<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Core;

use Rappasoft\LaravelLivewireTables\Features\Columns\Core\Configuration\ColumnCollapsingConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Columns\Core\Helpers\ColumnCollapsingHelpers;
use Rappasoft\LaravelLivewireTables\Features\Columns\Core\Styling\HasColumnCollapsingStyling;

trait WithColumnsCollapsing
{
    use ColumnCollapsingConfiguration,
        ColumnCollapsingHelpers,
        HasColumnCollapsingStyling;

    /**
     * Determines if any Columns have Collapse Behaviour
     *
     * @var boolean
     */
    protected bool $collapsingColumnsStatus = true;

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
