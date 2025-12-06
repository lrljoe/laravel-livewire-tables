<?php

namespace Rappasoft\LaravelLivewireTables\Features\Search\Traits;

use Livewire\Attributes\Computed;

trait HandlesSearchVisibility
{
    protected bool $searchVisibilityStatus = true;

    public function getSearchVisibilityStatus(): bool
    {
        return $this->searchVisibilityStatus;
    }

    /**
     * Undocumented function
     */
    public function searchVisibilityIsEnabled(): bool
    {
        return $this->getSearchVisibilityStatus() === true;
    }

    public function searchVisibilityIsDisabled(): bool
    {
        return $this->getSearchVisibilityStatus() === false;
    }

    public function setSearchVisibilityStatus(bool $status): self
    {
        $this->searchVisibilityStatus = $status;

        return $this;
    }

    public function setSearchVisibilityEnabled(): self
    {
        return $this->setSearchVisibilityStatus(true);
    }

    public function setSearchVisibilityDisabled(): self
    {
        return $this->setSearchVisibilityStatus(false);
    }
}
