<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits;

trait HasFilterSessionStorage
{
    public function storeFiltersInSessionStatus(bool $status): self
    {
        $this->setSessionStorageStatus('filters', $status);

        return $this;
    }

    public function storeFiltersInSessionEnabled(): self
    {
        return $this->storeFiltersInSessionStatus(true);
    }

    public function storeFiltersInSessionDisabled(): self
    {
        return $this->storeFiltersInSessionStatus(false);
    }


    public function shouldStoreFiltersInSession(): bool
    {
        return $this->getSessionStorageStatus('filters');
    }

    public function getFilterSessionKey(): string
    {
        return $this->getTableName().'-stored-filters';
    }

    public function storeFilterValues(): void
    {
        if ($this->shouldStoreFiltersInSession()) {
            $this->clearStoredFilterValues();
            session([$this->getFilterSessionKey() => $this->appliedFilters]);
        }
    }

    public function restoreFilterValues(): void
    {
        if (empty($this->appliedFilters)) {
            $this->appliedFilters = $this->getStoredFilterValues();
        }
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getStoredFilterValues(): array
    {
        if ($this->shouldStoreFiltersInSession() && session()->has($this->getFilterSessionKey())) {
            return session()->get($this->getFilterSessionKey());
        }

        return [];
    }

    public function clearStoredFilterValues(): void
    {
        if ($this->shouldStoreFiltersInSession() && session()->has($this->getFilterSessionKey())) {
            session()->forget($this->getFilterSessionKey());
        }
    }
}

    
