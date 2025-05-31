<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\IsAggregateColumn;

class AvgColumn extends AggregateColumn
{
    use IsAggregateColumn;

    /**
     * Undocumented variable
     *
     * @var string
     */
    public string $aggregateMethod = 'avg';

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
