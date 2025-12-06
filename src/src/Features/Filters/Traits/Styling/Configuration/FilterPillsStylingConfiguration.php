<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Styling\Configuration;

trait FilterPillsStylingConfiguration
{
    /**
     * Set Hiding Filter Pills While Loading Status
     */
    protected function setShowFilterPillsWhileLoading(bool $status): self
    {
        $this->showFilterPillsWhileLoading = $status;

        return $this;
    }

    /**
     * Set Hiding Filter Pills While Loading Enabled
     */
    protected function showFilterPillsWhileLoadingEnabled(): self
    {
        return $this->setShowFilterPillsWhileLoading(true);
    }

    /**
     * Set Hiding Filter Pills While Loading Disabled
     */
    protected function showFilterPillsWhileLoadingDisabled(): self
    {
        return $this->setShowFilterPillsWhileLoading(false);
    }

    /**
     * Set Filter Pill - Item Attributes
     *
     * @param  array<string,string>  $attributes
     */
    protected function setFilterPillsItemAttributes(array $attributes = []): self
    {
        return $this->setInternalAttribute('filterPillsItemAttributes', $attributes);
    }

    /**
     * Set Filter Pill -  Reset Individual Filter Button Attributes
     *
     * @param  array<string,string|bool>  $attributes
     */
    protected function setFilterPillsResetFilterButtonAttributes(array $attributes = []): self
    {
        return $this->setInternalAttribute('filterPillsResetFilterButtonAttributes', $attributes);
    }

    /**
     * Set Filter Pills - Reset All Button Attributes
     *
     * @param  array<mixed>  $attributes
     */
    protected function setFilterPillsResetAllButtonAttributes(array $attributes = []): self
    {
        return $this->setInternalAttribute('filterPillsResetAllButtonAttributes', $attributes);
    }
}
