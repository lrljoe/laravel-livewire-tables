<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Styling;

use Closure;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\Configuration\FilterMenuStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\Helpers\FilterMenuStylingHelpers;

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
