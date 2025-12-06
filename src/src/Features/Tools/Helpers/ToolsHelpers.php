<?php

namespace Rappasoft\LaravelLivewireTables\Features\Tools\Helpers;

use Livewire\Attributes\Computed;

trait ToolsHelpers
{
    /**
     * Undocumented function
     */
    public function getToolsStatus(): bool
    {
        return $this->toolsStatus;
    }

    /**
     * Undocumented function
     */
    public function shouldShowToolsFilterSlidedown(): bool
    {
        if (! method_exists($this, 'filtersAreEnabled') || ! method_exists($this, 'isFilterLayoutSlideDown')) {
            return false;
        } else {
            return ($this->filtersAreEnabled() && $this->filtersVisibilityIsEnabled() && $this->hasVisibleFilters()) && $this->isFilterLayoutSlideDown();
        }
    }

    /**
     * Undocumented function
     */
    #[Computed]
    public function shouldShowTools(): bool
    {
        if ($this->getToolsStatus()) {
            if ($this->shouldShowToolBar()) {
                return true;
            } else {
                if ($this->showSortPillsSection()) { // Sort Pills Are Enabled
                    return true;
                } elseif (method_exists($this, 'showFilterPillsSection') ? $this->showFilterPillsSection() : false) { // Filter Pills Are Enable)
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
}
