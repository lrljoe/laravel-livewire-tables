<?php

namespace Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Concerns;

trait HandlesSelectAll
{
    /**
     * Undocumented function
     */
    public function getSelectAllStatus(): bool
    {
        return $this->getBulkActionConfig('selectAll');
    }

    /**
     * Undocumented function
     */
    public function selectAllIsEnabled(): bool
    {
        return $this->getSelectAllStatus() === true;
    }

    /**
     * Undocumented function
     */
    public function selectAllIsDisabled(): bool
    {
        return $this->getSelectAllStatus() === false;
    }

    /**
     * Undocumented function
     */
    public function getDelaySelectAllStatus(): bool
    {
        return $this->bulkActionConfig['delaySelectAll'] ?? false;
    }

    /**
     * Undocumented function
     */
    public function setSelectAllStatus(bool $status): self
    {
        // $this->selectAll = $status;
        $this->setBulkActionConfig('selectAll', $status);

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setSelectAllEnabled(): self
    {
        $this->setSelectAllStatus(true);

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setSelectAllDisabled(): self
    {
        $this->setSelectAllStatus(false);

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setDelaySelectAllStatus(bool $status): self
    {
        return $this->setBulkActionConfig('delaySelectAll', $status);
    }

    /**
     * Undocumented function
     */
    public function setDelaySelectAllEnabled(): self
    {
        return $this->setDelaySelectAllStatus(true);
    }

    /**
     * Undocumented function
     */
    public function setDelaySelectAllDisabled(): self
    {
        return $this->setDelaySelectAllStatus(false);
    }
}
