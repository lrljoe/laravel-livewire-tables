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
     */
    protected function setupQueryStringStatusForSort(): void
    {
        if (! $this->hasQueryStringStatusForSort()) {
            $this->setQueryStringForSortEnabled();
        }
    }

    /**
     * Undocumented function
     */
    public function hasQueryStringStatusForSort(): bool
    {
        return $this->hasQueryStringConfigStatus('sorts');
    }

    /**
     * Undocumented function
     */
    public function getQueryStringStatusForSort(): bool
    {
        return $this->getQueryStringConfigStatus('sorts');
    }

    /**
     * Undocumented function
     */
    public function queryStringForSortEnabled(): bool
    {
        $this->setupQueryStringStatusForSort();

        return $this->getQueryStringStatusForSort() && $this->sortingIsEnabled();
    }

    /**
     * Undocumented function
     */
    public function setQueryStringStatusForSort(bool $status): self
    {
        return $this->setQueryStringConfigStatus('sorts', $status);
    }

    /**
     * Undocumented function
     */
    public function setQueryStringForSortEnabled(): self
    {
        return $this->setQueryStringStatusForSort(true);
    }

    /**
     * Undocumented function
     */
    public function setQueryStringForSortDisabled(): self
    {
        return $this->setQueryStringStatusForSort(false);
    }

    /**
     * Undocumented function
     */
    public function hasQueryStringAliasForSort(): bool
    {
        return $this->hasQueryStringConfigAlias('sorts');
    }

    /**
     * Undocumented function
     */
    public function getQueryStringAliasForSort(): string
    {
        return $this->getQueryStringConfigAlias('sorts');
    }

    /**
     * Undocumented function
     */
    public function setQueryStringAliasForSort(string $alias): self
    {
        return $this->setQueryStringConfigAlias('sorts', $alias);
    }
}
