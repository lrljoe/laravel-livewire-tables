<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Core\Configuration;

use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Aggregates\AggregateColumn;
use Rappasoft\LaravelLivewireTables\Collections\ColumnCollection;

trait ColumnConfiguration
{
    /**
     * Set the user defined columns
     */
    public function setColumns(): void
    {
        $columns = new ColumnCollection($this->getPrependedColumns())->concat($this->columns())->concat(new ColumnCollection($this->getAppendedColumns()));
        $this->columns = $columns->filter(fn ($column) => $column instanceof Column);
    }

    protected function setupColumns(): void
    {
        if(empty($this->columns))
        {
            $this->setColumns();
        }
        $this->columns = $this->columns
            ->map(function (Column $column) {
                $column->setTheme($this->getTheme())
                    ->setHasTableRowUrl($this->hasTableRowUrl())
                    ->setIsReorderColumn($this->getDefaultReorderColumn() == $column->getField());

                if ($column->hasFooter()) {
                    $this->columnsWithFooter = true;
                }
                if ($column->hasSecondaryHeader()) {
                    $this->columnsWithSecondaryHeader = true;
                }

                if ($column instanceof AggregateColumn) {
                    if ($column->getAggregateMethod() == 'count' && $column->hasDataSource()) {
                        $this->addExtraWithCount($column->getDataSource());
                    } elseif ($column->getAggregateMethod() == 'sum' && $column->hasDataSource() && $column->hasForeignColumn()) {
                        $this->addExtraWithSum($column->getDataSource(), $column->getForeignColumn());
                    } elseif ($column->getAggregateMethod() == 'avg' && $column->hasDataSource() && $column->hasForeignColumn()) {
                        $this->addExtraWithAvg($column->getDataSource(), $column->getForeignColumn());
                    }
                }

                if ($column->hasField()) {
                    if ($column->isBaseColumn()) {
                        $column->setTable($this->getBuilder()->getModel()->getTable());
                    } else {
                        $column->setTable($this->getTableForColumn($column));
                    }
                }

                return $column;
            });

        $this->hasRunColumnSetup = true;
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $prependedColumns
     * @return void
     */
    public function setPrependedColumns(array $prependedColumns): void
    {
        $this->prependedColumns = new ColumnCollection($prependedColumns);
        $this->hasRunColumnSetup = false;
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $appendedColumns
     * @return void
     */
    public function setAppendedColumns(array $appendedColumns): void
    {
        $this->appendedColumns = new ColumnCollection($appendedColumns);
        $this->hasRunColumnSetup = false;
    }
}
