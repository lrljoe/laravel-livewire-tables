<?php

namespace Rappasoft\LaravelLivewireTables\Features\Pagination\QueryString;

trait HasQueryStringForPagination
{
    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function queryStringHasQueryStringForPagination(): array
    {
        return ($this->queryStringForPaginationEnabled()) ?
        ['perPage' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->hasQueryStringAliasForPagination()]] : [];

    }

    protected function setupQueryStringStatusForPagination(): void
    {
        if (! $this->hasQueryStringStatusForPagination()) {
            $this->setQueryStringForPaginationEnabled();
        }
    }

    public function hasQueryStringStatusForPagination(): bool
    {
        return $this->hasQueryStringConfigStatus('pagination');
    }

    public function getQueryStringStatusForPagination(): bool
    {
        return $this->getQueryStringConfigStatus('pagination');
    }

    public function queryStringForPaginationEnabled(): bool
    {
        $this->setupQueryStringStatusForPagination();

        return $this->getQueryStringStatusForPagination();
    }

    public function setQueryStringStatusForPagination(bool $status): self
    {
        return $this->setQueryStringConfigStatus('pagination', $status);
    }

    public function setQueryStringForPaginationEnabled(): self
    {
        return $this->setQueryStringStatusForPagination(true);
    }

    public function setQueryStringForPaginationDisabled(): self
    {
        return $this->setQueryStringStatusForPagination(false);
    }

    public function hasQueryStringAliasForPagination(): bool
    {
        return $this->hasQueryStringConfigAlias('pagination');
    }

    public function getQueryStringAliasForPagination(): string
    {
        return $this->getQueryStringConfigAlias('pagination');
    }

    public function setQueryStringAliasForPagination(string $alias): self
    {
        return $this->setQueryStringConfigAlias('pagination', $alias);
    }
}
