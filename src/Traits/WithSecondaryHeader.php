<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\SecondaryHeaderConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\SecondaryHeaderHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\HasSecondaryHeaderStyling;

trait WithSecondaryHeader
{
    use SecondaryHeaderConfiguration,
        SecondaryHeaderHelpers,
        HasSecondaryHeaderStyling;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $secondaryHeaderStatus = true;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $columnsWithSecondaryHeader = false;
}
