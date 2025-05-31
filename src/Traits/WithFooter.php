<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Closure;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\FooterConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\FooterHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\HasFooterStyling;

trait WithFooter
{
    use FooterConfiguration,
        FooterHelpers,
        HasFooterStyling;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $footerStatus = true;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $useHeaderAsFooterStatus = false;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $columnsWithFooter = false;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $showColumnTitlesInFooter = false;
}
