<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\Helpers;

use Livewire\Attributes\Computed;

trait FilterPillsStylingHelpers
{
    #[Computed]
    public function displayFilterPillsWhileLoading(): bool
    {
        return $this->showFilterPillsWhileLoading;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getFilterPillsItemAttributes(): array
    {
        return $this->filterPillsItemAttributes;
    }

    
    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getFilterPillsResetFilterButtonAttributes(): array
    {
        return $this->filterPillsResetFilterButtonAttributes;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getFilterPillsResetAllButtonAttributes(): array
    {
        return $this->filterPillsResetAllButtonAttributes;
    }
}
