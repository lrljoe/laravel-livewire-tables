<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Concerns;

use Rappasoft\LaravelLivewireTables\Events\ColumnsSelected;

trait HandlesColumnSelectDropdown
{
    /**
     * Select All Columns
     */
    public function selectAllColumns(): void
    {
        $this->selectedColumns = $this->columnSelectConfig['selected'] = $this->columnSelectConfig['selectableColumns'] = [];

        foreach ($this->getSelectableColumns() as $column) {
            $this->columnSelectConfig['selected'][] = $this->selectedColumns[] = $column->getSlug();
            $this->columnSelectConfig['selectableColumns'][$column->getSlug()] = in_array($column->getSlug(), $this->selectedColumns, true);
        }
        $this->pushToQueryString($this->selectedColumns);
        $this->storeColumnSelectValues();

        if ($this->getEventStatusColumnSelect()) {
            event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->selectedColumns));
        }
    }

    /**
     * Deselect All Columns
     */
    public function deselectAllColumns(): void
    {
        $this->selectedColumns = [];
        $this->columnSelectConfig['selected'] = [];

        $this->columnSelectConfig['selectableColumns'] = [];
        foreach ($this->getSelectableColumns() as $column) {
            $this->columnSelectConfig['selectableColumns'][] = $column->getSlug();
        }
        $this->pushToQueryString($this->selectedColumns);
        session([$this->getColumnSelectSessionKey() => []]);
        if ($this->getEventStatusColumnSelect()) {
            event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->selectedColumns));
        }
    }

    /**
     * Toggle Columns Between All and None
     */
    public function toggleAllColumns(): void
    {
        if ($this->getSelectableSelectedColumns()->count() == $this->getSelectableColumns()->count()) {
            $this->deselectAllColumns();
        } else {
            $this->selectAllColumns();
        }
    }
}
