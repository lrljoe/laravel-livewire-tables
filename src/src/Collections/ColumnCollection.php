<?php

namespace Rappasoft\LaravelLivewireTables\Collections;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

/**
 * Collection of Columns
 *
 * @extends \Illuminate\Support\Collection<int|string,Column>
 */
class ColumnCollection extends Collection
{
    public function visible(): self
    {
        return $this->reject(fn (Column $column) => $column->isHidden());
    }

    public function selectable(): self
    {
        return $this->reject(fn (Column $column) => ! $column->isSelectable());
    }

    public function unselectable(): self
    {
        return $this->reject(fn (Column $column) => $column->isSelectable());
    }

    public function selected(): self
    {
        return $this->reject(fn (Column $column) => $column->isSelectable() && ! $column->isSelected());
    }

    public function sortable(): self
    {
        return $this->reject(fn (Column $column) => ! $column->isSortable() && ! $column->hasSortCallback());
    }

    public function visibleSortableColumns(): self
    {
        return $this
            ->visible()
            ->selected()
            ->sortable();
    }

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $sortKeys
     */
    public function visibleSortableColumnsKeyed(array $sortKeys = []): self
    {
        return $this
            ->visible()
            ->selected()
            ->sortable()
            ->whereIn('slug', $sortKeys)
            ->keyBy('slug');
    }

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $selectedColumns
     */
    public function selectedInTable(array $selectedColumns): self
    {
        return $this->reject(function (Column $column) use ($selectedColumns) {
            return ! empty($selectedColumns) && in_array($column->getSlug(), $selectedColumns, true);
        });
    }

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $selectedColumns
     */
    public function rejectUnselectedColumns(array $selectedColumns): self
    {
        return $this->reject(function (Column $column) use ($selectedColumns) {
            return $column->isSelectable() && ! empty($selectedColumns) && in_array($column->getSlug(), $selectedColumns, true);
        });
    }

    /**
     * Undocumented function
     */
    public function visibleOnReorder(): self
    {
        return $this->reject(fn (Column $column) => ! $column->isVisibleOnReorder());
    }

    /**
     * Undocumented function
     */
    public function rejectInvisibleWhileReordering(bool $currentlyReordering = false): self
    {
        return $this->reject(function (Column $column) use ($currentlyReordering) {
            return $currentlyReordering && ! $column->isVisibleOnReorder();
        });
    }

    /**
     * Undocumented function
     */
    public function reorder(): self
    {
        return $this->reject(fn (Column $column) => ! $column->isVisibleOnReorder());
    }

    /**
     * Undocumented function
     */
    public function visibleSelectable(): self
    {
        return $this->visible()->selectable();
    }
}
