<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Aggregates;

use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Aggregates\Traits\IsAggregateColumn;

class AvgColumn extends AggregateColumn
{
    use IsAggregateColumn;

    /**
     * Undocumented variable
     */
    public string $aggregateMethod = 'avg';

    /**
     * Undocumented function
     */
    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(fn () => null);
    }
}
