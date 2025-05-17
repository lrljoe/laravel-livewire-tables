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
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $collapsingColumnsStatus = true;

    /**
     * Undocumented variable
     *
     * @var boolean|null
     */
    protected ?bool $shouldAlwaysCollapse;

    /**
     * Undocumented variable
     *
     * @var boolean|null
     */
    protected ?bool $shouldMobileCollapse;

    /**
     * Undocumented variable
     *
     * @var boolean|null
     */
    protected ?bool $shouldTabletCollapse;
}
