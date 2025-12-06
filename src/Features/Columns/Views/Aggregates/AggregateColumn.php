<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Aggregates;

use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Aggregates\Traits\IsAggregateColumn;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

class AggregateColumn extends Column
{
    use IsAggregateColumn;

    /**
     * Undocumented variable
     *
     * @var string|null
     */
    public ?string $dataSource;

    /**
     * Undocumented variable
     *
     * @var string
     */
    public string $aggregateMethod = 'count';

    /**
     * Undocumented variable
     *
     * @var string|null
     */
    public ?string $foreignColumn;

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
