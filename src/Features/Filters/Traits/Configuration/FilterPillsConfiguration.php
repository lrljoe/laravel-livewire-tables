<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Configuration;

trait FilterPillsConfiguration
{
    public function setFilterPillsStatus(bool $status): self
    {
        $this->filterConfiguration['filterPillsStatus'] = $status;

        return $this;
    }

    public function setFilterPillsEnabled(): self
    {
        return $this->setFilterPillsStatus(true);
    }

    public function setFilterPillsDisabled(): self
    {
        return $this->setFilterPillsStatus(false);
    }
}
