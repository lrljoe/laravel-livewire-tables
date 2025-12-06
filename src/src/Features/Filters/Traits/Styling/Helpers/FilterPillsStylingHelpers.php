<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Styling\Helpers;

use Livewire\Attributes\Computed;

trait FilterPillsStylingHelpers
{
    /**
     * Should Filter Pills Display While Loading
     */
    public function displayFilterPillsWhileLoading(): bool
    {
        return $this->showFilterPillsWhileLoading;
    }

    /**
     * Retrieves The Attributes for Filter Pills Items
     *
     * @return array<mixed>
     */
    public function getFilterPillsItemAttributes(): array
    {
        return $this->filterPillsItemAttributes;
    }

    /**
     * Retrieves Filter Pill Reset Button Attributes
     *
     * @return array<mixed>
     */
    public function getFilterPillsResetFilterButtonAttributes(): array
    {
        return $this->filterPillsResetFilterButtonAttributes;
    }

    /**
     * Retrieves Filter Pill Reset All Button Attributes
     *
     * @return array<mixed>
     */
    public function getFilterPillsResetAllButtonAttributes(): array
    {
        return $this->filterPillsResetAllButtonAttributes;
    }
}
