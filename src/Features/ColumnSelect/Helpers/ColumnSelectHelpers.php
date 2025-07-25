<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Helpers;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;
use Rappasoft\LaravelLivewireTables\Collections\ColumnCollection;

trait ColumnSelectHelpers
{

    /**
     * Undocumented function
     *
     * @param mixed $column
     * @return boolean
     */
    public function columnSelectIsEnabledForColumn(mixed $column): bool
    {
        return !empty($this->selectedColumns) && in_array($column instanceof Column ? $column->getSlug() : $column, $this->selectedColumns ?? [], true);
    }



    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function getExcludeDeselectedColumnsFromQuery(): bool
    {
        return $this->columnSelectConfig['excludeDeselectedColumnsFromQuery'];
    }


    /**
     * Generate the Column Selectable Array
     *
     * @return array<mixed>
     */
    public function generateColumnSelect(): array
    {
        $items = [];
        foreach($this->getSelectableColumns() as $col)
        {
           $items[strval($col->getSlug())] = in_array(strval($col->getSlug()), $this->selectedColumns ?? []);
        }
        return $items;
    }


    /**
     * Generate the Column Select Options
     *
     * @return array<mixed>
     */
    public function generateColumnSelectItems(): array
    {
        $items = [];
        foreach($this->getSelectableColumns() as $col)
        {
            $stringSlug = strval($col->getSlug());

            $items[$stringSlug] = ['selected' => in_array($stringSlug, $this->selectedColumns ?? []), 'slug' => $stringSlug, 'title' => $col->getColumnSelectTitle()];
        }
        return $items;
    }
    

    /**
     * Undocumented function
     *
     * @return ColumnCollection<int,Column>
     */
    public function getSelectableColumns(): ColumnCollection
    {
        return $this->getColumns()
            ->visible()
            ->selectable()
            ->rejectInvisibleWhileReordering($this->currentlyReorderingIsEnabled())
            ->values();
    }

    /**
     * Undocumented function
     *
     * @return ColumnCollection<int,Column>
     */
    public function getSelectableSelectedColumns(): ColumnCollection
    {
        
        return $this->getColumns()
            ->visible()
            ->selectable()
            ->reject(fn (Column $column) => !in_array($column->getSlug(), $this->selectedColumns ?? []))
            ->rejectInvisibleWhileReordering($this->currentlyReorderingIsEnabled())
            ->values();
    }

    /**
     * Undocumented function
     *
     * @return ColumnCollection<int,Column>
     */
    public function getUnSelectableColumns(): ColumnCollection
    {
        return $this->getColumns()
            ->visible()
            ->unselectable()
            ->rejectInvisibleWhileReordering($this->currentlyReorderingIsEnabled())
            ->values();
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getSelectedColumns(): array
    {
        return $this->selectedColumns ?? [];
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getSelectedColumnsForQuery(): array
    {
        return $this->getColumns()
            ->visible()
            ->reject(fn (Column $column) => $column->isLabel())
            ->reject(fn (Column $column) => ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column)))
            ->rejectInvisibleWhileReordering($this->currentlyReorderingIsEnabled())
            ->values()
            ->toArray();
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getColumnsForColumnSelect(): array
    {
        return $this->getColumns()
            ->visible()
            ->selectable()
            ->reject(fn (Column $column) => !$column->isSelectable() || ! $this->columnSelectIsEnabledForColumn($column))
            ->rejectInvisibleWhileReordering($this->currentlyReorderingIsEnabled())
            ->keyBy(function (Column $column, int $key) {
                return $column->getSlug();
            })
            ->map(fn ($column) => $column->getTitle())
            ->toArray();
    }

    #[Computed]
    public function getColumnsForColumnSelectCount(): int
    {
        return count($this->getColumnsForColumnSelect());
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getDefaultVisibleColumns(): array
    {
        return $this->getColumns()
            ->visible()
            ->reject(fn (Column $column) => $column->isSelectable() && ! $column->isSelected())
            ->reject(fn (Column $column) => !$column->isSelectable())
            ->rejectInvisibleWhileReordering($this->currentlyReorderingIsEnabled())
            ->map(fn ($column) => $column->getSlug())
            ->values()
            ->toArray();
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function getAllColumnsAreSelected(): bool
    {
        return $this->getSelectableSelectedColumns()->count() === $this->getSelectableColumns()->count();
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    #[Computed]
    public function selectedVisibleColumns(): array
    {
        return $this->getColumns()
            ->visible()
            ->reject(fn (Column $column) => ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column)))
            ->rejectInvisibleWhileReordering($this->currentlyReorderingIsEnabled())
            ->values()
            ->toArray();
    }


    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function allVisibleColumnsAreSelected(): bool
    {
        return count($this->selectedColumns) === count($this->getDefaultVisibleColumns());
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function allSelectedColumnsAreVisibleByDefault(): bool
    {
        return count($this->selectedColumns) === count($this->getDefaultVisibleColumns());
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function setupColumnSelect(): void
    {

        // If the column select is off, make sure to clear the session
        if ($this->columnSelectIsDisabled() && session()->has($this->getColumnSelectSessionKey())) {
            session()->forget($this->getColumnSelectSessionKey());
        }

        if (empty($this->columnSelectConfig['selectableColumns'])) {
            $this->columnSelectConfig['selectableColumns'] = $this->getColumnsForColumnSelect();
        }
        $this->setupFirstColumnSelectRun();

        // If remember selection is off, then clear the session
        if (! $this->shouldStoreColumnSelectInSession()) {
            $this->forgetColumnSelectSession();
        }

        // Set to either the default set or what is stored in the session
        $selectedColumns = (count($this->selectedColumns) > 1) ?
            $this->selectedColumns :
            session()->get($this->getColumnSelectSessionKey(), $this->getDefaultVisibleColumns());

        // Check to see if there are any excluded that are already stored in the enabled and remove them
        /*foreach ($this->getColumns() as $column) {
            if (! $column->isSelectable() && ! in_array($column->getSlug(), $selectedColumns, true)) {
                $selectedColumns[] = $column->getSlug();
            }
        }*/
        //$this->selectedColumns = $selectedColumns;
        // $this->storeColumnSelectValues();
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function defaultSelectedColumns(): array
    {
        $selectedColumns = (count($this->selectedColumns) > 1) ?
            $this->selectedColumns :
            session()->get($this->getColumnSelectSessionKey(), $this->getDefaultVisibleColumns());

        foreach ($this->getColumns() as $column) {
            if (! $column->isSelectable() && ! in_array($column->getSlug(), $selectedColumns, true)) {
                $selectedColumns[] = $column->getSlug();
            }
        }

        return $selectedColumns;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function setupFirstColumnSelectRun(): void
    {
        if (! $this->columnSelectConfig['setupRun']) {
            $this->columnSelectConfig['deselected'] = $this->columnSelectConfig['defaultdeselected'] = $this->setDefaultDeselectedColumns();
            $this->columnSelectConfig['setupRun'] = true;
        }

    }

    public function getColumnSelectDelay(): int
    {
        return $this->columnSelectConfig['columnSelectDelay'] ?? 1500;
    }

}
