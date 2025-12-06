<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing\Configuration;

trait ColumnCollapsingConfiguration
{

    public function unsetCollapsedStatuses(): void
    {
        unset($this->shouldAlwaysCollapse); /* @phpstan-ignore unset.possiblyHookedProperty */
        unset($this->shouldMobileCollapse); /* @phpstan-ignore unset.possiblyHookedProperty */
        unset($this->shouldTabletCollapse); /* @phpstan-ignore unset.possiblyHookedProperty */
    }
}
