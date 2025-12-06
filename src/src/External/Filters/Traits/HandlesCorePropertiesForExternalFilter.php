<?php

namespace Rappasoft\LaravelLivewireTables\External\Filters\Traits;

trait HandlesCorePropertiesForExternalFilter
{
    /**
     * Undocumented variable
     */
    public string $filterKey = '';

    /**
     * Undocumented variable
     */
    public string $tableName = 'table';

    public string $dataTableFingerprint = 'unknown';

    /**
     * Undocumented variable
     */
    public string $tableComponent = '';

    /**
     * Undocumented function
     */
    protected function Key(string $filterKey): self
    {
        $this->filterKey = $filterKey;

        return $this;
    }

    /**
     * Undocumented function
     */
    public function getFilterKey(): string
    {
        return $this->filterKey;
    }

    /**
     * Undocumented function
     */
    protected function setTableName(string $tableName): self
    {
        $this->tableName = $tableName;

        return $this;
    }

    /**
     * Undocumented function
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * Undocumented function
     */
    protected function setTableComponent(string $tableComponent): self
    {
        $this->tableComponent = $tableComponent;

        return $this;
    }

    /**
     * Undocumented function
     */
    public function getTableComponent(): string
    {
        return $this->tableComponent;
    }
}
