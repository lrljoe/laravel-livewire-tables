<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait CollapsingColumnConfiguration
{
    public function setCollapsingColumnsStatus(bool $status): self
    {
        $this->collapsingColumnsStatus = $status;

        return $this;
    }

    public function setCollapsingColumnsEnabled(): self
    {
        $this->setCollapsingColumnsStatus(true);

        return $this;
    }

    public function setCollapsingColumnsDisabled(): self
    {
        $this->setCollapsingColumnsStatus(false);

        return $this;
    }

    public function unsetCollapsedStatuses(): void
    {
        unset($this->shouldAlwaysCollapse); /* @phpstan-ignore unset.possiblyHookedProperty */
        unset($this->shouldMobileCollapse); /* @phpstan-ignore unset.possiblyHookedProperty */
        unset($this->shouldTabletCollapse); /* @phpstan-ignore unset.possiblyHookedProperty */
    }
}
