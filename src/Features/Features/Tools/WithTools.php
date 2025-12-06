<?php

namespace Rappasoft\LaravelLivewireTables\Features\Tools;

use Rappasoft\LaravelLivewireTables\Features\Tools\Configuration\ToolsConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Tools\Helpers\ToolsHelpers;
use Rappasoft\LaravelLivewireTables\Features\Tools\Styling\HasToolsStyling;

trait WithTools
{
    use ToolsConfiguration,
        ToolsHelpers,
        HasToolsStyling,
        WithToolBar;
        
    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $toolsStatus = true;

}
