<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

trait HasFiltersStatus
{
    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setFiltersStatus(bool $status): self
    {
        $this->filterConfiguration['filtersStatus'] = $status;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setFiltersEnabled(): self
    {
        return $this->setFiltersStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setFiltersDisabled(): self
    {
        return $this->setFiltersStatus(false);
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function getFiltersStatus(): bool
    {
        return $this->filterConfiguration['filtersStatus'];
    } 

    /**
     * Undocumented function
     * 
     * @return boolean
     */
    public function filtersAreEnabled(): bool
    {
        return $this->getFiltersStatus() === true;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function filtersAreDisabled(): bool
    {
        return $this->getFiltersStatus() === false;
    }
}
