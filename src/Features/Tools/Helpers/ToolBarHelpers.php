<?php

namespace Rappasoft\LaravelLivewireTables\Features\Tools\Helpers;

use Livewire\Attributes\Computed;

trait ToolBarHelpers
{

    public function getToolBarStatus(): bool
    {
        return $this->toolBarStatus;
    }

    #[Computed]
    public function shouldShowToolBar(): bool
    {
        if ($this->getToolsStatus() == false) {
            return false;
        }

        if ($this->getToolBarStatus()) {
            if (
                $this->hasToolbarConfigurableAreas() || // Has Configured Toolbar Configurable Areas
                $this->hasToolbarActions() ||  // Actions Exist In Toolbar
                $this->hasToolbarReorder() ||  // If Reorder Is Enabled
                $this->hasToolbarColumnSelect() || // Column Select Enabled
                $this->displayToolbarSearch() || // If Search Is Enabled
                $this->displayToolbarFilters() ||  // If Filters Are Enabled
                $this->displayToolbarPagination()  // Pagination Selection Is Enabled
            ) {
                return true;
            }

            return false;
        }

        return false;
    }

    #[Computed]
    public function displayToolbarPagination(): bool
    {
        return $this->paginationIsEnabled() && $this->perPageVisibilityIsEnabled();
    }

    #[Computed]
    public function displayToolbarSearch(): bool
    {
        if (method_exists($this, 'searchIsEnabled') && method_exists($this, 'searchVisibilityIsEnabled'))
        {
            return $this->searchIsEnabled() && $this->searchVisibilityIsEnabled();
        }
        return false;
    }

    #[Computed]
    public function displayToolbarFilters(): bool
    {
        return $this->filtersAreEnabled() && (($this->filtersVisibilityIsEnabled() && $this->hasVisibleFilters()) || ($this->showBulkActionsDropdownAlpine() && $this->shouldAlwaysHideBulkActionsDropdownOption() != true));
    }

    protected function hasToolbarColumnSelect(): bool
    {
        return $this->columnSelectIsEnabled();
    }

    protected function hasToolbarReorder(): bool
    {
        return $this->reorderIsEnabled();
    }

    protected function hasToolbarConfigurableAreas(): bool
    {
        return $this->hasConfigurableAreaFor('toolbar-left-start') || $this->hasConfigurableAreaFor('toolbar-left-end') || $this->hasConfigurableAreaFor('toolbar-right-start') || $this->hasConfigurableAreaFor('toolbar-right-end');
    }

    protected function hasToolbarActions(): bool
    {
        return $this->hasActions() && $this->showActionsInToolbar();
    }

    /**
     * Undocumented function
     *
     * @param string $section
     * @return boolean
     */
    public function showToolbarSection(string $section): bool
    {
        if ($section == 'search')
        {
            if(!method_exists($this,'showSearchField'))
            {
                return false;
            }
            else
            {
                return $this->showSearchField();
            }
        }
        elseif ($section == 'reorder')
        {
            if(!method_exists($this,'showReorderButton'))
            {
                return false;
            }
            else
            {
                return $this->showReorderButton();
            }
        }
        elseif ($section == 'filters')
        {
            if(!method_exists($this,'showFiltersButton'))
            {
                return false;
            }
            else
            {
                return $this->showFiltersButton();
            }
        }
        return false;
    }


    protected function getToolbarItemsLeft()
    {
        $items = $startItems = $endItems = [];

        if($this->hasConfigurableAreaFor('toolbar-left-start'))
        {
            $startItems[] = 'toolbar-left-start';
        }

        if($this->hasConfigurableAreaFor('toolbar-left-end'))
        {
            $endItems[] = 'toolbar-left-end';
        }

        if($this->showActionsInToolbarLeft())
        {
            $endItems[] = 'actions';
        }

        return [...$startItems, ...$this->toolbarItemsLeft(), ...$endItems];
    }

    protected function getToolbarItemsRight()
    {
        $items = $startItems = $endItems = [];

        if($this->hasConfigurableAreaFor('toolbar-right-start'))
        {
            $startItems[] = 'toolbar-right-start';
        }

        if($this->hasConfigurableAreaFor('toolbar-right-end'))
        {
            $endItems[] = 'toolbar-right-end';
        }

        if($this->showActionsInToolbarRight())
        {
            $startItems[] = 'actions';
        }

        return [...$startItems, ...$this->toolbarItemsRight(), ...$endItems];
    }


    protected function setupToolbarItemsLeft()
    {
        $items = [];

        foreach($this->getToolbarItemsLeft() as $key => $val)
        {
            $item = $this->getToolbarItemFor($val);
            if(!empty($item))
            {
                $items[] = $item;
            }
        }
        
        return $items;
    }

    protected function setupToolbarItemsRight()
    {
        $items = [];

        foreach($this->getToolbarItemsRight() as $key => $val)
        {
            $item = $this->getToolbarItemFor($val);
            if(!empty($item))
            {
                $items[] = $item;
            }
        }

        return $items;
    }

    protected function setupToolbarItems()
    {
        $this->toolBarItems['left'] = $this->setupToolbarItemsLeft();
        $this->toolBarItems['right'] = $this->setupToolbarItemsRight();
    }
}
