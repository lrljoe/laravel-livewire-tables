<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Styling;

use Closure;
use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Styling\Configuration\FilterMenuStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Styling\Helpers\FilterMenuStylingHelpers;

trait HasFilterMenuStyling
{
    use FilterMenuStylingConfiguration,
        FilterMenuStylingHelpers;

        /**
         * Undocumented variable
         *
         * @var array<mixed>
         */
    protected array $filterPopoverAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true, 'default-width' => true];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $filterSlidedownWrapperAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    protected ?Closure $filterSlidedownRowCallback;
}
