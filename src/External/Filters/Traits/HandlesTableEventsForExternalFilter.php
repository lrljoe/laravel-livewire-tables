<?php

namespace Rappasoft\LaravelLivewireTables\External\Filters\Traits;

use Livewire\Attributes\{On,Renderless};

trait HandlesTableEventsForExternalFilter
{
    
    /**
     * Undocumented function
     *
     * @param string $tableName
     * @param string $filterKey
     * @param array<mixed> $value
     * @return void
     */
    #[On('filter-was-set')]
    public function setFilterValues(string $tableName, string $filterKey, string|array|null $value = []): void
    {
        if (! is_null($value) && $tableName == $this->tableName && $filterKey == $this->filterKey && $this->optionsSelected != $value) {
            $this->optionsSelected = $value;
        }
    }

    
    /**
     * Undocumented function
     *
     * @param \Illuminate\View\View $view
     * @param array<mixed> $data
     * @return void
     */
    #[Renderless]
    public function renderingHandlesTableEventsForExternalFilter(\Illuminate\View\View $view, array $data = []): void
    {
        if ($this->needsUpdating) {
            $this->needsUpdating = false;
            $this->dispatch('livewireArrayFilterUpdateValuesNew', tableName: $this->tableName, filterKey: $this->filterKey, values: $this->optionsSelected)->to($this->tableComponent);
        }
    }
}
