<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

use Rappasoft\LaravelLivewireTables\Traits\Filters\Configuration\FilterGenericDataConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Helpers\FilterGenericDataHelpers;

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
