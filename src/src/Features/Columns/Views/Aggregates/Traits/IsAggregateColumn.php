<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Aggregates\Traits;

use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\IsColumn;

trait IsAggregateColumn
{
    use IsColumn,
        AggregateColumnHelpers,
        AggregateColumnConfiguration { AggregateColumnHelpers::getContents insteadof IsColumn;
            AggregateColumnConfiguration::sortable insteadof IsColumn; }
}
