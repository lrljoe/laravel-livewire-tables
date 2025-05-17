<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait SortingConfiguration
{
    /**
     * Undocumented function
     *
     * @return void
     */
    protected function setupDefaultSorting(): void
    {
        if ($this->sortingIsEnabled() && $this->hasDefaultSort() && ! $this->hasSorts()) {
            $this->setSort($this->getDefaultSortColumn(), $this->getDefaultSortDirection());
        }
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setSortingStatus(bool $status): self
    {
        $this->sortingStatus = $status;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setSortingEnabled(): self
    {
        $this->setSortingStatus(true);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setSortingDisabled(): self
    {
        $this->setSortingStatus(false);
        $this->sorts = [];

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setSingleSortingStatus(bool $status): self
    {
        $this->singleColumnSortingStatus = $status;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setSingleSortingEnabled(): self
    {
        return $this->setSingleSortingStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setSingleSortingDisabled(): self
    {
        return $this->setSingleSortingStatus(false);
    }

    /**
     * Undocumented function
     *
     * @param string $field
     * @param string $direction
     * @return self
     */
    public function setDefaultSort(string $field, string $direction = 'asc'): self
    {
        $this->defaultSortColumn = $field;
        $this->defaultSortDirection = $direction;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function removeDefaultSort(): self
    {
        $this->defaultSortColumn = null;
        $this->defaultSortDirection = 'asc';

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setSortingPillsStatus(bool $status): self
    {
        $this->sortingPillsStatus = $status;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setSortingPillsEnabled(): self
    {
        return $this->setSortingPillsStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setSortingPillsDisabled(): self
    {
        return $this->setSortingPillsStatus(false);
    }

    /**
     * Undocumented function
     *
     * @param string $asc
     * @param string $desc
     * @return self
     */
    public function setDefaultSortingLabels(string $asc, string $desc): self
    {
        $this->defaultSortingLabelAsc = $asc;
        $this->defaultSortingLabelDesc = $desc;

        return $this;
    }
}
