<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Styling;

use Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\Configuration\FilterPillsStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\Helpers\FilterPillsStylingHelpers;

trait HasFilterPillsStyling
{
    use FilterPillsStylingConfiguration,
        FilterPillsStylingHelpers;


        /**
         * Undocumented variable
         *
         * @var array<mixed>
         */
    protected array $filterPillsItemAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $filterPillsResetFilterButtonAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $filterPillsResetAllButtonAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    protected bool $showFilterPillsWhileLoading = true;
}
