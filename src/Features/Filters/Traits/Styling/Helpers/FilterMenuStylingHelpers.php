<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Styling\Helpers;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait FilterMenuStylingHelpers
{
    /**
     * Used to get attributes for the Filter Popover
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getFilterPopoverAttributes(): array
    {
        return $this->filterPopoverAttributes;

    }

    /**
     * Used to get attributes for the Filter Slidedown Wrapper
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getFilterSlidedownWrapperAttributes(): array
    {
        return $this->filterSlidedownWrapperAttributes;

    }

    /**
     * Used to get attributes for the Filter Slidedown Row
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getFilterSlidedownRowAttributes(string $rowIndex): array
    {

        if (isset($this->filterSlidedownRowCallback)) {
            return array_merge(['class' => '', 'default-colors' => true, 'default-styling' => true, 'row' => (int) $rowIndex], call_user_func($this->filterSlidedownRowCallback, (int) $rowIndex));
        }

        return ['class' => '', 'default-colors' => true, 'default-styling' => true, 'row' => (int) $rowIndex];
    }

    /**
     * Used to get attributes for the Filter Menu Reset Button
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getFilterMenuResetButtonAttributes(): array
    {
        return $this->filterMenuResetButtonAttributes;

    }

    #[Computed]
    public function getFilterMenuResetButtonAttributesBag(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->filterMenuResetButtonAttributes);

    }
}
