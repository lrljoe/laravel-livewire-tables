<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\EventConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\EventHelpers;

trait WithEvents
{
    use EventConfiguration,
        EventHelpers;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $eventStatuses = ['columnSelected' => true, 'searchApplied' => false, 'filterApplied' => false];
}
