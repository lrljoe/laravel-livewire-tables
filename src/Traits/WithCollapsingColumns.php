<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\CollapsingColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\CollapsingColumnHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Columns\HasCollapsingColumnsStyling;

trait WithCollapsingColumns
{
    use CollapsingColumnConfiguration,
        CollapsingColumnHelpers,
        HasCollapsingColumnsStyling;

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
