<?php

namespace Rappasoft\LaravelLivewireTables\Features\Tools\Helpers;

use Livewire\Attributes\Computed;

trait ToolBarHelpers
{
    /**
     * Undocumented function
     */
    public function getToolBarStatus(): bool
    {
        return $this->toolBarStatus;
    }

    /**
     * Undocumented function
     */
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

    /**
     * Undocumented function
     */
    #[Computed]
    public function displayToolbarPagination(): bool
    {
        return $this->paginationIsEnabled() && $this->perPageVisibilityIsEnabled();
    }

    /**
     * Undocumented function
     */
    #[Computed]
    public function displayToolbarSearch(): bool
    {
        if (method_exists($this, 'searchIsEnabled') && method_exists($this, 'searchVisibilityIsEnabled')) {
            return $this->searchIsEnabled() && $this->searchVisibilityIsEnabled();
        }

        return false;
    }

    /**
     * Undocumented function
     */
    #[Computed]
    public function displayToolbarFilters(): bool
    {
        return $this->filtersAreEnabled() && (($this->filtersVisibilityIsEnabled() && $this->hasVisibleFilters()) || ($this->showBulkActionsDropdownAlpine() && $this->shouldAlwaysHideBulkActionsDropdownOption() != true));
    }

    /**
     * Undocumented function
     */
    protected function hasToolbarColumnSelect(): bool
    {
        return $this->columnSelectIsEnabled();
    }

    /**
     * Undocumented function
     */
    protected function hasToolbarReorder(): bool
    {
        return $this->reorderIsEnabled();
    }

    /**
     * Undocumented function
     */
    protected function hasToolbarConfigurableAreas(): bool
    {
        return $this->hasConfigurableAreaFor('toolbar-left-start') || $this->hasConfigurableAreaFor('toolbar-left-end') || $this->hasConfigurableAreaFor('toolbar-right-start') || $this->hasConfigurableAreaFor('toolbar-right-end');
    }

    /**
     * Undocumented function
     */
    protected function hasToolbarActions(): bool
    {
        return $this->hasActions() && $this->showActionsInToolbar();
    }

    /**
     * Undocumented function
     */
    public function showToolbarSection(string $section): bool
    {
        if ($section == 'search') {
            if (! method_exists($this, 'showSearchField')) {
                return false;
            } else {
                return $this->showSearchField();
            }
        } elseif ($section == 'reorder') {
            if (! method_exists($this, 'showReorderButton')) {
                return false;
            } else {
                return $this->showReorderButton();
            }
        } elseif ($section == 'filters') {
            if (! method_exists($this, 'showFiltersButton')) {
                return false;
            } else {
                return $this->showFiltersButton();
            }
        }

        return false;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function getToolbarItemsLeft(): array
    {
        $items = $startItems = $endItems = [];

        if ($this->hasConfigurableAreaFor('toolbar-left-start')) {
            $startItems[] = 'toolbar-left-start';
        }

        if ($this->hasConfigurableAreaFor('toolbar-left-end')) {
            $endItems[] = 'toolbar-left-end';
        }

        if ($this->showActionsInToolbarLeft()) {
            $endItems[] = 'actions';
        }

        return [...$startItems, ...$this->toolbarItemsLeft(), ...$endItems];
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function getToolbarItemsRight(): array
    {
        $items = $startItems = $endItems = [];

        if ($this->hasConfigurableAreaFor('toolbar-right-start')) {
            $startItems[] = 'toolbar-right-start';
        }

        if ($this->hasConfigurableAreaFor('toolbar-right-end')) {
            $endItems[] = 'toolbar-right-end';
        }

        if ($this->showActionsInToolbarRight()) {
            $startItems[] = 'actions';
        }

        return [...$startItems, ...$this->toolbarItemsRight(), ...$endItems];
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function setupToolbarItemsLeft(): array
    {
        $items = [];

        foreach ($this->getToolbarItemsLeft() as $key => $val) {
            $item = $this->getToolbarItemFor($val);
            if (! empty($item)) {
                $items[] = $item;
            }
        }

        return $items;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function setupToolbarItemsRight(): array
    {
        $items = [];

        foreach ($this->getToolbarItemsRight() as $key => $val) {
            $item = $this->getToolbarItemFor($val);
            if (! empty($item)) {
                $items[] = $item;
            }
        }

        return $items;
    }

    /**
     * Undocumented function
     */
    protected function setupToolbarItems(): void
    {
        $this->toolBarItems['left'] = $this->setupToolbarItemsLeft();
        $this->toolBarItems['right'] = $this->setupToolbarItemsRight();
    }
}
