<?php

namespace Rappasoft\LaravelLivewireTables\DataTransferObjects;

class FilterGenericData
{
    /**
     * Undocumented variable
     */
    public string $tableName;

    /**
     * Undocumented variable
     */
    public string $dataTableFingerprint;

    /**
     * Undocumented variable
     */
    public string $filterLayout;

    /**
     * Undocumented variable
     */
    public bool $isTailwind = false;

    /**
     * Undocumented variable
     */
    public bool $isTailwind4 = false;

    /**
     * Undocumented variable
     */
    public bool $isBootstrap4 = false;

    /**
     * Undocumented variable
     */
    public bool $isBootstrap5 = false;

    /**
     * Undocumented function
     */
    public function __construct(string $tableName, string $dataTableFingerprint, string $filterLayout, bool $isTailwind = false, bool $isBootstrap4 = false, bool $isBootstrap5 = false, bool $isTailwind4 = false)
    {
        $this->tableName = $tableName;
        $this->dataTableFingerprint = $dataTableFingerprint;
        $this->filterLayout = $filterLayout;
        $this->isTailwind = $isTailwind;
        $this->isTailwind4 = $isTailwind4;
        $this->isBootstrap4 = $isBootstrap4;
        $this->isBootstrap5 = $isBootstrap5;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return [
            'tableName' => $this->tableName,
            'dataTableFingerprint' => $this->dataTableFingerprint,
            'filterLayout' => $this->filterLayout,
            'isTailwind' => $this->isTailwind,
            'isTailwind4' => $this->isTailwind4,
            'isBootstrap' => ($this->isBootstrap4 || $this->isBootstrap5),
            'isBootstrap4' => $this->isBootstrap4,
            'isBootstrap5' => $this->isBootstrap5,
            'localisationPath' => (config('livewire-tables.use_json_translations', false)) ? 'livewire-tables::' : 'livewire-tables::core.',
        ];
    }
}
