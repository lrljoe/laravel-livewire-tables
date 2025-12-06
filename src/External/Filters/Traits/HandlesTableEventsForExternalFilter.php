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
     * @param string|array<mixed>|null $value
     * @return void
     */
    //#[On('filter-was-set')]
    public function Values(string $tableName, string $filterKey, string|array|null $value = []): void
    {
        if(!is_array($value))
        {
            $value = [$value];
        }
        if ($tableName == $this->tableName && $filterKey == $this->filterKey && $this->optionsSelected != $value) {
            $this->selectedItems = $this->optionsSelected = $value;
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
            $this->dispatch('livewireExternalArrayFilterUpdate', dataTableFingerprint: $this->dataTableFingerprint, returnValues: $this->returnValues, tableName: $this->tableName, filterKey: $this->filterKey, values: $this->optionsSelected, optionsAvailable: $this->newOptionsAvailable)->to($this->tableComponent);
            $this->dispatch('livewireExternalArrayFilterValuesUpdateNew', dataTableFingerprint: $this->dataTableFingerprint ?? 'test', filterKey: $this->filterKey, filterOptions: $this->newOptionsAvailable, selectedValues: $this->optionsSelected);

            $this->newOptionsAvailable = [];
        }
    }
}            

