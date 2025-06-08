<?php

namespace Rappasoft\LaravelLivewireTables\Features\Tools\Helpers;

use Livewire\Attributes\Computed;

trait ToolsHelpers
{
    public function getToolsStatus(): bool
    {
        return $this->toolsStatus;
    }


    public function shouldShowToolsFilterSection(): bool
    {
        if (!method_exists($this, 'filtersAreEnabled'))
        {
            return false;
        }
        else
        {
            return ($this->filtersAreEnabled() && $this->filtersVisibilityIsEnabled() && $this->hasVisibleFilters() && $this->isFilterLayoutSlideDown());
        }
    }

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
