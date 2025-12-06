<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Aggregates;

use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Aggregates\Traits\IsAggregateColumn;

class CountColumn extends AggregateColumn
{
    use IsAggregateColumn;

    /**
     * Undocumented variable
     *
     * @var string
     */
    public string $aggregateMethod = 'count';

    /**
     * Undocumented function
     *
     * @param string $title
     * @param string|null $from
     */
    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(fn () => null);
    }
}
