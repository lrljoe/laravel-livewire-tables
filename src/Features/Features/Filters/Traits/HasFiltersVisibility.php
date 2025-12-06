<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Configuration\FilterVisibilityConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Helpers\FilterVisibilityHelpers;

trait HasFiltersVisibility
{
    use FilterVisibilityConfiguration,
        FilterVisibilityHelpers;
}
