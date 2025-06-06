<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Core\Helpers;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

trait ColumnHelpers
{


    /**
     * Undocumented function
     *
     * @return Collection<int,Column>
     */
    public function getColumns(): Collection
    {
        if (! $this->hasRunColumnSetup) {
            $this->setupColumns();
        }

        return $this->columns;
    }

    /**
     * Undocumented function
     *
     * @param string $qualifiedColumn
     * @return Column|null
     */
    public function getColumn(string $qualifiedColumn): ?Column
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->isColumn($qualifiedColumn))
            ->first();
    }

    /**
     * Undocumented function
     *
     * @param string $qualifiedColumn
     * @return Column|null
     */
    public function getColumnBySelectName(string $qualifiedColumn): ?Column
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->isColumnBySelectName($qualifiedColumn))
            ->first();
    }

    /**
     * Undocumented function
     *
     * @param string $columnSlug
     * @return Column|null
     */
    public function getColumnBySlug(string $columnSlug): ?Column
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->isColumnBySlug($columnSlug))
            ->first();
    }

    /**
     * @return array<mixed>
     */
    public function getColumnRelations(): array
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->hasRelations())
            ->map(fn (Column $column) => $column->getRelations())
            ->values()
            ->toArray();
    }

    /**
     * @return array<mixed>
     */
    public function getColumnRelationStrings(): array
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->hasRelations())
            ->map(fn (Column $column) => $column->getRelationString())
            ->values()
            ->toArray();
    }

    /**
     * Undocumented function
     *
     * @return Collection<int,Column>
     */
    public function getSearchableColumns(): Collection
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->isSearchable() || $column->hasSearchCallback());
    }

    /**
     * Undocumented function
     *
     * @return Collection<int,string>
     */
    public function getSortableColumns(): Collection
    {
        return isset($this->sortableColumns) ? $this->sortableColumns : $this->sortableColumns = $this->getColumns()
            ->filter(fn (Column $column) => ($column->isSortable() || $column->hasSortCallback()))
            ->map(fn (Column $column) => $column->getColumnSelectName() ?? $column->getSlug())
            ->values();
    }

    public function getColumnCount(): int
    {
        return $this->getColumns()->count();
    }

    /**
     * Undocumented function
     *
     * @return Collection<int,Column>
     */
    public function getPrependedColumns(): Collection
    {
        return $this->prependedColumns ?? collect($this->prependColumns());
    }

    /**
     * Undocumented function
     *
     * @return Collection<int,Column>
     */
    public function getAppendedColumns(): Collection
    {
        return $this->appendedColumns ?? collect($this->appendColumns());
    }

    /**
     * Prepend columns.
     *
     * @return array<mixed>
     */
     public function prependColumns(): array
    {
        return [];
    }

    /**
     * Append Columns
     *
     * @return array<mixed>
     */
    public function appendColumns(): array
    {
        return [];
    }
}
