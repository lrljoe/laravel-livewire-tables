<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Styling;

use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Styling\Configuration\FilterPillsStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Styling\Helpers\FilterPillsStylingHelpers;

trait HasFilterPillsStyling
{
    use FilterPillsStylingConfiguration,
        FilterPillsStylingHelpers;


    /**
     * Undocumented variable
     *
     * @var array<string,string|boolean>
    */
    protected array $filterPillsItemAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    /**
     * Undocumented variable
     *
     * @var array<string,string|boolean>
     */
    protected array $filterPillsResetFilterButtonAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    /**
     * Undocumented variable
     *
     * @var array<string,string|boolean>
     */
    protected array $filterPillsResetAllButtonAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    protected bool $showFilterPillsWhileLoading = true;
}
