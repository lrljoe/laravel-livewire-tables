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
            $this->dispatch('livewireExternalArrayFilterUpdate', tableName: $this->tableName, filterKey: $this->filterKey, values: $this->optionsSelected)->to($this->tableComponent);
        }
    }
}            

