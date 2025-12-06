<?php

namespace Rappasoft\LaravelLivewireTables\Features\Search\Traits;

use Livewire\Attributes\{Computed, Locked};

trait HandlesSearchStatus
{
    #[Locked]
    public bool $searchStatus = true;

    public function getSearchStatus(): bool
    {
        return $this->searchStatus;
    }

    /**
     * Undocumented function
     */
    public function showSearchField(): bool
    {
        return $this->searchIsEnabled() && $this->searchVisibilityIsEnabled();
    }

    /**
     * Undocumented function
     */
    public function searchIsEnabled(): bool
    {
        return $this->getSearchStatus() === true;
    }

    public function searchIsDisabled(): bool
    {
        return $this->getSearchStatus() === false;
    }

    public function setSearchStatus(bool $status): self
    {
        $this->searchStatus = $status;

        return $this;
    }

    public function setSearchEnabled(): self
    {
        $this->setSearchStatus(true);

        return $this;
    }

    /**
     * @return $this
     */
    public function setSearchDisabled(): self
    {
        $this->search = '';

        $this->setSearchStatus(false);

        return $this;
    }
}
