<?php

namespace Rappasoft\LaravelLivewireTables\DataTransferObjects;

use Rappasoft\LaravelLivewireTables\DataTableComponent;

class DebuggableData
{
    /**
     * Undocumented variable
     *
     * @var DataTableComponent
     */
    public DataTableComponent $component;

    /**
     * Undocumented function
     *
     * @param DataTableComponent $component
     */
    public function __construct(DataTableComponent $component)
    {
        $this->component = $component;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return [
            'query' => (clone $this->component->getBuilder())->toSql(),
            'filters' => $this->component->getAppliedFilters(),
            'sorts' => $this->component->getSorts(),
            'search' => (method_exists($this->component, 'getSearch') ? $this->component->getSearch() : ''),
            'select-all' => $this->component->getSelectAllStatus(),
            'selected' => $this->component->getSelected(),
        ];
    }
}
