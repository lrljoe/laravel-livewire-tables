<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits;

use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Configuration\FilterGenericDataConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Helpers\FilterGenericDataHelpers;

trait HasFilterGenericData
{
    use FilterGenericDataConfiguration,
        FilterGenericDataHelpers;

    /**
     * Generic Data for Filters
     *
     * @var array<mixed>
     */
    protected array $filterGenericData = [];
}
