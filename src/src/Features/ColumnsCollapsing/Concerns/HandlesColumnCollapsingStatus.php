<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing\Concerns;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Collections\ColumnCollection;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

trait HandlesColumnCollapsingStatus
{
    /**
     * Determines if any Columns have Collapse Behaviour
     */
    protected bool $collapsingColumnsStatus = true;

    /**
     * Set Collapsing Column Function Status
     */
    protected function setCollapsingColumnsStatus(bool $status): self
    {
        $this->collapsingColumnsStatus = $status;

        return $this;
    }

    /**
     * Enable Collapsing Column Function
     */
    protected function setCollapsingColumnsEnabled(): self
    {
        $this->setCollapsingColumnsStatus(true);

        return $this;
    }

    /**
     * Disable Collapsing Column Function
     */
    protected function setCollapsingColumnsDisabled(): self
    {
        $this->setCollapsingColumnsStatus(false);

        return $this;
    }

    /**
     * Determines if Collapsing Columns Status Is True
     */
    public function getCollapsingColumnsStatus(): bool
    {
        return $this->collapsingColumnsStatus;
    }

    /**
     * Determines that Current Table has any Collapsing Columns
     */
    #[Computed]
    public function collapsingColumnsAreEnabled(): bool
    {
        return $this->getCollapsingColumnsStatus() === true;
    }

    /**
     * Determines that Current Table does not have any Collapsing Columns
     */
    #[Computed]
    public function collapsingColumnsAreDisabled(): bool
    {
        return $this->getCollapsingColumnsStatus() === false;
    }
}
