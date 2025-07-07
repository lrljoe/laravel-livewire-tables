<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Configuration;

use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

trait ColumnSelectConfiguration
{
    public function setColumnSelectStatus(bool $status): self
    {
        $this->columnSelectStatus = $status;

        return $this;
    }

    public function setColumnSelectEnabled(): self
    {
        return $this->setColumnSelectStatus(true);
    }

    public function setColumnSelectDisabled(): self
    {
       return $this->setColumnSelectStatus(false);
    }

    public function setRememberColumnSelectionStatus(bool $status): self
    {
        $this->storeColumnSelectInSessionStatus($status);

        return $this;
    }

    public function setRememberColumnSelectionEnabled(): self
    {
        return $this->setRememberColumnSelectionStatus(true);
    }

    public function setRememberColumnSelectionDisabled(): self
    {
        return $this->setRememberColumnSelectionStatus(false);
    }

    public function setExcludeDeselectedColumnsFromQuery(bool $status): self
    {
        $this->excludeDeselectedColumnsFromQuery = $status;

        return $this;
    }

    public function setExcludeDeselectedColumnsFromQueryEnabled(): self
    {
        return $this->setExcludeDeselectedColumnsFromQuery(true);
    }

    public function setExcludeDeselectedColumnsFromQueryDisabled(): self
    {
        return $this->setExcludeDeselectedColumnsFromQuery(false);
    }

    public function setColumnSelectHiddenOnMobile(): self
    {
        $this->columnSelectHiddenOnMobile = true;

        return $this;
    }

    public function setColumnSelectHiddenOnTablet(): self
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
