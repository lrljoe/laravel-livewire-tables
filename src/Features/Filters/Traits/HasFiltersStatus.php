<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits;

trait HasFiltersStatus
{
    /**
     * Undocumented function
     */
    public function setFiltersStatus(bool $status): self
    {
        $this->filterConfiguration['filtersStatus'] = $status;

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setFiltersEnabled(): self
    {
        return $this->setFiltersStatus(true);
    }

    /**
     * Undocumented function
     */
    public function setFiltersDisabled(): self
    {
        return $this->setFiltersStatus(false);
    }

    /**
     * Undocumented function
     */
    public function getFiltersStatus(): bool
    {
        return $this->filterConfiguration['filtersStatus'];
    }

    /**
     * Undocumented function
     */
    public function filtersAreEnabled(): bool
    {
        return $this->getFiltersStatus() === true;
    }

    /**
     * Undocumented function
     */
    public function filtersAreDisabled(): bool
    {
        return $this->getFiltersStatus() === false;
    }
}
