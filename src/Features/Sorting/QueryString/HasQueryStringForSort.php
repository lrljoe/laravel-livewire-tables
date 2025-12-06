<?php

namespace Rappasoft\LaravelLivewireTables\Features\Sorting\QueryString;

trait HasQueryStringForSort
{
    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function queryStringHasQueryStringForSort(): array
    {
        return ($this->queryStringForSortEnabled() && $this->sortingIsEnabled()) ? ['sorts' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAliasForSort()]] : [];

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function setupQueryStringStatusForSort(): void
    {
        if (! $this->hasQueryStringStatusForSort()) {
            $this->setQueryStringForSortEnabled();
        }
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function hasQueryStringStatusForSort(): bool
    {
        return $this->hasQueryStringConfigStatus('sorts');
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function getQueryStringStatusForSort(): bool
    {
        return $this->getQueryStringConfigStatus('sorts');
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function queryStringForSortEnabled(): bool
    {
        $this->setupQueryStringStatusForSort();

        return $this->getQueryStringStatusForSort() && $this->sortingIsEnabled();
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setQueryStringStatusForSort(bool $status): self
    {
        return $this->setQueryStringConfigStatus('sorts', $status);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setQueryStringForSortEnabled(): self
    {
        return $this->setQueryStringStatusForSort(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setQueryStringForSortDisabled(): self
    {
        return $this->setQueryStringStatusForSort(false);
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function hasQueryStringAliasForSort(): bool
    {
        return $this->hasQueryStringConfigAlias('sorts');
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getQueryStringAliasForSort(): string
    {
        return $this->getQueryStringConfigAlias('sorts');
    }

    /**
     * Undocumented function
     *
     * @param string $alias
     * @return self
     */
    public function setQueryStringAliasForSort(string $alias): self
    {
        return $this->setQueryStringConfigAlias('sorts', $alias);
    }
}
