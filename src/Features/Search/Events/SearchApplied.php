<?php

namespace Rappasoft\LaravelLivewireTables\Features\Search\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Rappasoft\LaravelLivewireTables\Events\LaravelLivewireTablesEvent;

class SearchApplied extends LaravelLivewireTablesEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Undocumented function
     */
    public function __construct(string $tableName, string $value)
    {
        $this->setTableForEvent($tableName)
            ->setValueForEvent($value)
            ->setUserForEvent();
    }
}
