<?php

namespace Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Concerns;


trait HandlesSelected
{

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
     *
     * @return boolean
     */
    public function hasSelected(): bool
    {
        return $this->getSelectedCount() > 0;
    }

    /**
     * Undocumented function
     *
     * @return integer
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
        $this->setSelected((clone $this->baseQuery())->pluck($this->getBuilder()->getModel()->getTable().'.'.$this->getPrimaryKey())->map(fn ($item) => (string) $item)->toArray());
    }
}