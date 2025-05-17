<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ColumnConfiguration
{
    /**
     * Undocumented function
     *
     * @param array<mixed> $prependedColumns
     * @return void
     */
    public function setPrependedColumns(array $prependedColumns): void
    {
        $this->prependedColumns = collect($prependedColumns);
        $this->hasRunColumnSetup = false;
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $appendedColumns
     * @return void
     */
    public function setAppendedColumns(array $appendedColumns): void
    {
        $this->appendedColumns = collect($appendedColumns);
        $this->hasRunColumnSetup = false;
    }
}
