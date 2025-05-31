<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Events\ColumnsSelected;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait ColumnSelectHelpers
{
    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function getColumnSelectStatus(): bool
    {
        return $this->columnSelectStatus;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    #[Computed]
    public function columnSelectIsEnabled(): bool
    {
        return $this->getColumnSelectStatus() === true;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function columnSelectIsDisabled(): bool
    {
        return $this->getColumnSelectStatus() === false;
    }

    /**
     * Undocumented function
     *
     * @param mixed $column
     * @return boolean
     */
    public function columnSelectIsEnabledForColumn(mixed $column): bool
    {
        return in_array($column instanceof Column ? $column->getSlug() : $column, $this->selectedColumns, true);
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function getColumnSelectIsHiddenOnTablet(): bool
    {
        return $this->columnSelectHiddenOnTablet;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function getExcludeDeselectedColumnsFromQuery(): bool
    {
        return $this->excludeDeselectedColumnsFromQuery;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function getColumnSelectIsHiddenOnMobile(): bool
    {
        return $this->columnSelectHiddenOnMobile;
    }

    /**
     * Undocumented function
     *
     * @return Collection<int,Column>
     */
    public function getSelectableColumns(): Collection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->isHidden())
            ->reject(fn (Column $column) => ! $column->isSelectable())
            ->reject(fn (Column $column) => $this->currentlyReorderingIsEnabled() && !$column->isVisibleOnReorder())
            ->values();
    }

    /**
     * Undocumented function
     *
     * @return Collection<int,Column>
     */
    public function getSelectableSelectedColumns(): Collection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->isHidden())
            ->reject(fn (Column $column) => ! $column->isSelectable())
            ->reject(fn (Column $column) => ! $this->columnSelectIsEnabledForColumn($column))
            ->reject(fn (Column $column) => $this->currentlyReorderingIsEnabled() && !$column->isVisibleOnReorder())
            ->values();
    }

    /**
     * Undocumented function
     *
     * @return Collection<int,Column>
     */
    public function getUnSelectableColumns(): Collection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->isHidden())
            ->reject(fn (Column $column) => $column->isSelectable())
            ->reject(fn (Column $column) => $this->currentlyReorderingIsEnabled() && !$column->isVisibleOnReorder())
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
            ->reject(fn (Column $column) => $column->isLabel())
            ->reject(fn (Column $column) => $column->isHidden())
            ->reject(fn (Column $column) => ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column)))
            ->reject(fn (Column $column) => $this->currentlyReorderingIsEnabled() && !$column->isVisibleOnReorder())
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
            ->reject(fn (Column $column) => ! $column->isSelectable())
            ->reject(fn (Column $column) => $column->isHidden())
            ->reject(fn (Column $column) => $this->currentlyReorderingIsEnabled() && !$column->isVisibleOnReorder())
            ->keyBy(function (Column $column, int $key) {
                return $column->getSlug();
            })
            ->map(fn ($column) => $column->getTitle())
            ->toArray();
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getDefaultVisibleColumns(): array
    {
        return collect($this->getColumns()
            ->reject(fn (Column $column) => $column->isHidden())
            ->reject(fn (Column $column) => $column->isSelectable() && ! $column->isSelected())
            ->reject(fn (Column $column) => $this->currentlyReorderingIsEnabled() && !$column->isVisibleOnReorder())
        )
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
            ->reject(fn (Column $column) => $column->isHidden())
            ->reject(fn (Column $column) => ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column)))
            ->reject(fn (Column $column) => $this->currentlyReorderingIsEnabled() && !$column->isVisibleOnReorder())
            ->values()
            ->toArray();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function selectAllColumns(): void
    {
        $this->selectedColumns = [];
        foreach ($this->getColumns() as $column) {
            $this->selectedColumns[] = $column->getSlug();
        }
        $this->storeColumnSelectValues();

        if ($this->getEventStatusColumnSelect()) {
            event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->selectedColumns));
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function deselectAllColumns(): void
    {
        $this->selectedColumns = [];
        session([$this->getColumnSelectSessionKey() => []]);
        if ($this->getEventStatusColumnSelect()) {
            event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->selectedColumns));
        }
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

            return;
        }

        if (empty($this->selectableColumns)) {
            $this->selectableColumns = $this->getColumnsForColumnSelect();
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
        foreach ($this->getColumns() as $column) {
            if (! $column->isSelectable() && ! in_array($column->getSlug(), $selectedColumns, true)) {
                $selectedColumns[] = $column->getSlug();
            }
        }
        $this->selectedColumns = $selectedColumns;
        // $this->storeColumnSelectValues();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function setupFirstColumnSelectRun(): void
    {
        if (! $this->columnSelectColumns['setupRun']) {
            $this->columnSelectColumns['deselected'] = $this->columnSelectColumns['defaultdeselected'] = $this->setDefaultDeselectedColumns();
            $this->columnSelectColumns['setupRun'] = true;
        }

    }


}
