<?php

namespace Rappasoft\LaravelLivewireTables\External\Filters\Traits;

trait HandlesCorePropertiesForExternalFilter
{
    /**
     * Undocumented variable
     *
     * @var string
     */
    public string $filterKey = '';

    /**
     * Undocumented variable
     *
     * @var string
     */
    public string $tableName = '';

    /**
     * Undocumented variable
     *
     * @var string
     */
    public string $tableComponent = '';

    /**
     * Undocumented function
     *
     * @param string $filterKey
     * @return self
     */
    protected function Key(string $filterKey): self
    {
        $this->filterKey = $filterKey;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getFilterKey(): string
    {
        return $this->filterKey;
    }

    /**
     * Undocumented function
     *
     * @param string $tableName
     * @return self
     */
    protected function setTableName(string $tableName): self
    {
        $this->tableName = $tableName;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * Undocumented function
     *
     * @param string $tableComponent
     * @return self
     */
    protected function setTableComponent(string $tableComponent): self
    {
        $this->tableComponent = $tableComponent;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getTableComponent(): string
    {
        return $this->tableComponent;
    }
}
