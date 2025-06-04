<?php

namespace Rappasoft\LaravelLivewireTables\DataTransferObjects;

class FilterGenericData
{
    /**
     * Undocumented variable
     *
     * @var string
     */
    public string $tableName;

    /**
     * Undocumented variable
     *
     * @var string
     */
    public string $filterLayout;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    public bool $isTailwind = false;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    public bool $isTailwind4 = false;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    public bool $isBootstrap4 = false;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    public bool $isBootstrap5 = false;

    /**
     * Undocumented function
     *
     * @param string $tableName
     * @param string $filterLayout
     * @param boolean $isTailwind
     * @param boolean $isBootstrap4
     * @param boolean $isBootstrap5
     * @param boolean $isTailwind4
     */
    public function __construct(string $tableName, string $filterLayout, bool $isTailwind = false, bool $isBootstrap4 = false, bool $isBootstrap5 = false, bool $isTailwind4 = false)
    {
        $this->tableName = $tableName;
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
