<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Aggregates;

use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Aggregates\Traits\IsAggregateColumn;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

class AggregateColumn extends Column
{
    use IsAggregateColumn;

    /**
     * Undocumented variable
     */
    public ?string $dataSource;

    /**
     * Undocumented variable
     */
    public string $aggregateMethod = 'count';

    /**
     * Undocumented variable
     */
    public ?string $foreignColumn;

    /**
     * Undocumented function
     */
    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(fn () => null);
    }
}
