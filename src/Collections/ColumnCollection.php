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

    public function visibleOnReorder() {
        return $this->reject(fn (Column $column) => !$column->isVisibleOnReorder());
    }


    public function reorder() {
        return $this->reject(fn (Column $column) => !$column->isVisibleOnReorder());
    }

    public function visibleSelectable() {
        return $this->visible()->selectable();
    }

}
