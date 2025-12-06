<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Aggregates;

use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Aggregates\Traits\IsAggregateColumn;

class SumColumn extends AggregateColumn
{
    use IsAggregateColumn;

    public string $aggregateMethod = 'sum';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(fn () => null);
    }


}
