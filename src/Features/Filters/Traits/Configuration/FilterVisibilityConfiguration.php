<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Configuration;

trait FilterVisibilityConfiguration
{
    public function setFiltersVisibilityStatus(bool $status): self
    {
        $this->filterConfiguration['visibilityStatus'] = $status;

        return $this;
    }

    public function setFiltersVisibilityEnabled(): self
    {
        return $this->setFiltersVisibilityStatus(true);
    }

    public function setFiltersVisibilityDisabled(): self
    {
        return $this->setFiltersVisibilityStatus(false);
    }
}
