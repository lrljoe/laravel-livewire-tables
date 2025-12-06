<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ColumnsSelected extends LaravelLivewireTablesEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $columns;

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $columns
     */
    public function __construct(string $tableName, string $key, array $columns = [])
    {
        $this->setTableForEvent($tableName)
            ->setKeyForEvent($key)
            ->setValueForEvent($columns)
            ->setUserForEvent();

        $this->columns = $columns;
    }
}
