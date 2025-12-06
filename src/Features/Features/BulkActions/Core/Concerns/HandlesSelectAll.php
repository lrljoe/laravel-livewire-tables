<?php

namespace Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Concerns;


trait HandlesSelectAll
{

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function getSelectAllStatus(): bool
    {
        return $this->getBulkActionConfig('selectAll');
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function selectAllIsEnabled(): bool
    {
        return $this->getSelectAllStatus() === true;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function selectAllIsDisabled(): bool
    {
        return $this->getSelectAllStatus() === false;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function getDelaySelectAllStatus(): bool
    {
        return $this->bulkActionConfig['delaySelectAll'] ?? false;
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setSelectAllStatus(bool $status): self
    {
        //$this->selectAll = $status;
        $this->setBulkActionConfig('selectAll', $status);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setSelectAllEnabled(): self
    {
        $this->setSelectAllStatus(true);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setSelectAllDisabled(): self
    {
        $this->setSelectAllStatus(false);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setDelaySelectAllStatus(bool $status): self
    {
        return $this->setBulkActionConfig('delaySelectAll', $status);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setDelaySelectAllEnabled(): self
    {
        return $this->setDelaySelectAllStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setDelaySelectAllDisabled(): self
    {
       return $this->setDelaySelectAllStatus(false);
    }

}