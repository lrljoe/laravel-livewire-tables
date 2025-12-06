<?php

namespace Rappasoft\LaravelLivewireTables\Features\Footer;

use Closure;
use Rappasoft\LaravelLivewireTables\Features\Footer\Configuration\FooterConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Footer\Helpers\FooterHelpers;
use Rappasoft\LaravelLivewireTables\Features\Footer\Styling\HasFooterStyling;

trait WithFooter
{
    use FooterConfiguration,
        FooterHelpers,
        HasFooterStyling;

    /**
     * Undocumented variable
     */
    protected bool $footerStatus = true;

    /**
     * Undocumented variable
     */
    protected bool $useHeaderAsFooterStatus = false;

    /**
     * Undocumented variable
     */
    protected bool $columnsWithFooter = false;

    /**
     * Undocumented variable
     */
    protected bool $showColumnTitlesInFooter = false;
}
