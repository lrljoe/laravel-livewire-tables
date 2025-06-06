<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Configuration\FilterMenuConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Helpers\FilterMenuHelpers;
use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Styling\HasFilterMenuStyling;

trait HasFilterMenu
{
    use FilterMenuConfiguration,
        FilterMenuHelpers,
        HasFilterMenuStyling;
}
