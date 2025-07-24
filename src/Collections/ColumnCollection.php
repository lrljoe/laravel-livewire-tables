<?php

namespace Rappasoft\LaravelLivewireTables\Collections;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

class ColumnCollection extends Collection
{
    public function visible() {
        return $this->reject(fn (Column $column) => $column->isHidden());
    }

    public function selectable() {
        return $this->reject(fn (Column $column) => !$column->isSelectable());
    }

    public function unselectable() {
        return $this->reject(fn (Column $column) => $column->isSelectable());
    }

    public function selected() {
        return $this->reject(fn (Column $column) => $column->isSelectable() && ! $column->isSelected());
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $selectedColumns
     */
    public function selectedInTable(array $selectedColumns) {
        return $this->reject(function (Column $column) use ($selectedColumns) {
            return !empty($selectedColumns) && in_array($column->getSlug(), $selectedColumns, true);
        });
    }


    /**
     * Undocumented function
     *
     * @param array<mixed> $selectedColumns
     */
    public function rejectUnselectedColumns(array $selectedColumns) {
        return $this->reject(function (Column $column) use ($selectedColumns) {
            return $column->isSelectable() && !empty($selectedColumns) && in_array($column->getSlug(), $selectedColumns, true);
        });
    }


    public function visibleOnReorder() {
        return $this->reject(fn (Column $column) => !$column->isVisibleOnReorder());
    }

    public function rejectInvisibleWhileReordering(bool $currentlyReordering = false) 
    {
        return $this->reject(function (Column $column) use ($currentlyReordering) {
            return $currentlyReordering && !$column->isVisibleOnReorder();
        });
    }

    public function reorder() {
        return $this->reject(fn (Column $column) => !$column->isVisibleOnReorder());
    }

    public function visibleSelectable() {
        return $this->visible()->selectable();
    }

}
