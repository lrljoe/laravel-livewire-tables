<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing\Concerns;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;
use Rappasoft\LaravelLivewireTables\Collections\ColumnCollection;

trait HandlesColumnCollapsingStatus
{
    /**
     * Determines if any Columns have Collapse Behaviour
     *
     * @var boolean
     */
    protected bool $collapsingColumnsStatus = true;

    /**
     * Set Collapsing Column Function Status
     *
     * @return self
     */
    protected function setCollapsingColumnsStatus(bool $status): self
    {
        $this->collapsingColumnsStatus = $status;

        return $this;
    }

    /**
     * Enable Collapsing Column Function
     *
     * @return self
     */
    protected function setCollapsingColumnsEnabled(): self
    {
        $this->setCollapsingColumnsStatus(true);

        return $this;
    }

    /**
     * Disable Collapsing Column Function
     *
     * @return self
     */
    protected function setCollapsingColumnsDisabled(): self
    {
        $this->setCollapsingColumnsStatus(false);

        return $this;
    }

    /**
     * Determines if Collapsing Columns Status Is True
     *
     * @return boolean
     */
    public function getCollapsingColumnsStatus(): bool
    {
        return $this->collapsingColumnsStatus;
    }

    /**
     * Determines that Current Table has any Collapsing Columns
     *
     * @return boolean
     */
    #[Computed]
    public function collapsingColumnsAreEnabled(): bool
    {
        return $this->getCollapsingColumnsStatus() === true;
    }

    /**
     * Determines that Current Table does not have any Collapsing Columns
     *
     * @return boolean
     */
    #[Computed]
    public function collapsingColumnsAreDisabled(): bool
    {
        return $this->getCollapsingColumnsStatus() === false;
    }
}