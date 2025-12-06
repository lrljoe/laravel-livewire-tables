<?php

namespace Rappasoft\LaravelLivewireTables\Features\Sorting\Configuration;

trait SortingConfiguration
{
    /**
     * Undocumented function
     */
    protected function setupDefaultSorting(): void
    {
        if ($this->sortingIsEnabled() && $this->hasDefaultSort() && ! $this->hasSorts()) {
            $this->setSort($this->getDefaultSortColumn(), $this->getDefaultSortDirection());
        }
    }

    /**
     * Undocumented function
     */
    public function setSortingStatus(bool $status): self
    {
        $this->sortingConfig['sortingStatus'] = $status;

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setSortingEnabled(): self
    {
        return $this->setSortingStatus(true);
    }

    /**
     * Undocumented function
     */
    public function setSortingDisabled(): self
    {
        $this->setSortingStatus(false);
        $this->clearSorts();

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setSingleSortingStatus(bool $status): self
    {
        $this->sortingConfig['singleColumnSortingStatus'] = $status;

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setSingleSortingEnabled(): self
    {
        return $this->setSingleSortingStatus(true);
    }

    /**
     * Undocumented function
     */
    public function setSingleSortingDisabled(): self
    {
        return $this->setSingleSortingStatus(false);
    }

    /**
     * Undocumented function
     */
    public function setDefaultSort(string $field, string $direction = 'asc'): self
    {
        $this->sortingConfig['defaultSortColumn'] = $field;
        $this->sortingConfig['defaultSortDirection'] = $direction;

        return $this;
    }

    /**
     * Undocumented function
     */
    public function removeDefaultSort(): self
    {
        $this->sortingConfig['defaultSortColumn'] = null;
        $this->sortingConfig['defaultSortDirection'] = 'asc';

        return $this;
    }
}
