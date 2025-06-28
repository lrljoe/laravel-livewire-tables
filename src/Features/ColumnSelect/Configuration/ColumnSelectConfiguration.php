<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Configuration;

use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

trait ColumnSelectConfiguration
{
    protected function setColumnSelectStatus(bool $status): self
    {
        $this->columnSelectStatus = $status;

        return $this;
    }

    protected function setColumnSelectEnabled(): self
    {
        return $this->setColumnSelectStatus(true);
    }

    protected function setColumnSelectDisabled(): self
    {
       return $this->setColumnSelectStatus(false);
    }

    protected function setRememberColumnSelectionStatus(bool $status): self
    {
        $this->storeColumnSelectInSessionStatus($status);

        return $this;
    }

    protected function setRememberColumnSelectionEnabled(): self
    {
        return $this->setRememberColumnSelectionStatus(true);
    }

    protected function setRememberColumnSelectionDisabled(): self
    {
        return $this->setRememberColumnSelectionStatus(false);
    }

    protected function setExcludeDeselectedColumnsFromQuery(bool $status): self
    {
        $this->excludeDeselectedColumnsFromQuery = $status;

        return $this;
    }

    protected function setExcludeDeselectedColumnsFromQueryEnabled(): self
    {
        return $this->setExcludeDeselectedColumnsFromQuery(true);
    }

    protected function setExcludeDeselectedColumnsFromQueryDisabled(): self
    {
        return $this->setExcludeDeselectedColumnsFromQuery(false);
    }

    protected function setColumnSelectHiddenOnMobile(): self
    {
        $this->columnSelectHiddenOnMobile = true;

        return $this;
    }

    protected function setColumnSelectHiddenOnTablet(): self
    {
        $this->columnSelectHiddenOnTablet = true;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function setDefaultDeselectedColumns(): array
    {
        return collect($this->getColumns()
            ->reject(fn (Column $column) => ! $column->isSelectable())
            ->reject(fn (Column $column) => $column->isSelectable() && $column->isSelected())
        )
            ->keyBy(function (Column $column, int $key) {
                return $column->getSlug();
            })
            ->map(fn ($column) => $column->getTitle())
            ->toArray();
    }

    protected function setColumnSelectDelay(int $delay): self
    {
        $this->columnSelectDelay = $delay;

        return $this;
    }
}
