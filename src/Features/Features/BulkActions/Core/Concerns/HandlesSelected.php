<?php

namespace Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Concerns;

trait HandlesSelected
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $recentlySelectedItems = [];

    /**
     * @param  array<mixed>  $selected
     * @return array<mixed>
     */
    public function setSelected(array $selected): array
    {
        return $this->selected = $selected;
    }

    /**
     * @return array<mixed>
     */
    public function getSelected(): array
    {
        return $this->selected;
    }

    /**
     * Undocumented function
     */
    public function hasSelected(): bool
    {
        return $this->getSelectedCount() > 0;
    }

    /**
     * Undocumented function
     */
    public function getSelectedCount(): int
    {
        return count($this->getSelected());
    }

    /**
     * Clear the bulk selected and disable select all
     */
    public function clearSelected(): void
    {
        $this->setSelectAllDisabled();
        $this->setSelected([]);
    }

    /**
     * Disable select all when the selected array is updated - if DelaySelectAll is not enabled
     */
    public function updatedSelected(): void
    {

        if (! $this->getDelaySelectAllStatus()) {
            $this->setSelectAllDisabled();
        }
    }

    /**
     * Set select all and get all ids for selected
     */
    public function setAllSelected(): void
    {
        $this->setSelectAllEnabled();
        $allPossibleItems = (clone $this->selectAllQuery())->pluck($this->getBuilder()->getModel()->getTable().'.'.$this->getPrimaryKey())->toArray();
        $this->setSelected($allPossibleItems);
    }
}
