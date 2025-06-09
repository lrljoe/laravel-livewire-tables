<?php

namespace Rappasoft\LaravelLivewireTables\Features\Tools\Helpers;


trait ToolBarItemHelpers
{
    protected function getToolbarItemFor(string $item)
    {
        if ($item == 'reorder')
        {
            return $this->getToolbarItemForReorder();
        }
        elseif ($item == 'filters')
        {
            return $this->getToolbarItemForFilters();
        }
        elseif ($item == 'search')
        {
            return $this->getToolbarItemForSearch();
        }
        elseif ($item == 'actions')
        {
            return $this->getToolbarItemForActions();
        }
        elseif($item == 'column-select')
        {
            return $this->getToolbarItemForColumnSelect();
        }
        elseif($item == 'pagination-dropdown')
        {
            return $this->getToolbarItemForPaginationDropdown();
        }
        elseif($item == 'bulk-actions')
        {
            return $this->getToolbarItemForBulkActions();
        }
        elseif($item == 'toolbar-left-start')
        {
            return $this->getToolbarItemConfigurableArea('toolbar-left-start');
        }
        elseif($item == 'toolbar-left-end')
        {
            return $this->getToolbarItemConfigurableArea('toolbar-left-end');
        }
        elseif($item == 'toolbar-right-start')
        {
            return $this->getToolbarItemConfigurableArea('toolbar-right-start');
        }
        elseif($item == 'toolbar-right-end')
        {
            return $this->getToolbarItemConfigurableArea('toolbar-right-end');
        }
    }

    protected function getToolbarItemConfigurableArea(string $area)
    {
        if($this->hasConfigurableAreaFor($area))
        {
            return ['view' => $this->getConfigurableAreaFor($area), 'attributes' => $this->getParametersForConfigurableArea($area)];
        }
        return [];
    }

    protected function getToolbarItemForReorder()
    {
        if($this->showToolbarSection('reorder'))
        {
            $allReorderButtonAttributes = $this->getAllReorderButtonAttributes();

            return ['view' => 'livewire-tables::includes.toolbar.items.reorder-buttons', 'attributes' => [
                'allReorderButtonAttributes' => $allReorderButtonAttributes,
                'reorderButtonStartAttributes' => $allReorderButtonAttributes['start'],
                'reorderButtonSaveAttributes' => $allReorderButtonAttributes['save'],
                'reorderButtonCancelAttributes' => $allReorderButtonAttributes['cancel'],
            ]];
        }
        return [];
    }

    protected function getToolbarItemForSearch()
    {
        if($this->showToolbarSection('search'))
        {
            return ['view' => 'livewire-tables::includes.toolbar.items.search', 'attributes' => $this->getSearchViewAttributes()];
        }
        return [];
    }

    protected function getToolbarItemForFilters()
    {
        if($this->showToolbarSection('filters'))
        {
            return ['view' => 'livewire-tables::includes.toolbar.items.filter-button', 'attributes' => [
                'filterBadgeCount' => $this->getFilterBadgeCount(),
                'isFilterLayoutPopover' => $this->isFilterLayoutPopover(),
                'isFilterLayoutSlideDown' => $this->isFilterLayoutSlideDown(),
                'searchIsEnabled' => $this->searchIsEnabled(),
            ]];
        }
        return [];
    }
    public function getToolbarActionAttributes()
    {
        return [
                'actionWrapperAttributes' => $this->getActionWrapperAttributes(),
                'actionButtonAttributes' => $this->getActionsButtonAttributes(),
                'actionsMenuAttributes' => $this->getActionsMenuAttributes(),
                'actionsPosition' => $this->getActionsPosition(),
                'showActionsAsDropdown' => $this->showActionsAsDropdown(),
                'showActionsInToolbar' => $this->showActionsInToolbar(),
        ];
    }

    protected function getToolbarItemForActions()
    {
        return ['view' => 'livewire-tables::includes.toolbar.items.actions',  'attributes' => [
                'actionWrapperAttributes' => $this->getActionWrapperAttributes(),
                'actionButtonAttributes' => $this->getActionsButtonAttributes(),
                'actionsMenuAttributes' => $this->getActionsMenuAttributes(),
                'actionsPosition' => $this->getActionsPosition(),
                'showActionsAsDropdown' => $this->showActionsAsDropdown(),
                'showActionsInToolbar' => $this->showActionsInToolbar(),
        ]];
    }

    protected function getToolbarItemForColumnSelect()
    {
        if($this->columnSelectIsEnabled())
        {
            return ['view' => 'livewire-tables::includes.toolbar.items.column-select', 'attributes' => [
                'csIsHiddenOnMobile' => $this->getColumnSelectIsHiddenOnMobile(),
                'csIsHiddenOnTablet' => $this->getColumnSelectIsHiddenOnTablet(),
                'columnSelectButtonAttributes' => $this->getColumnSelectButtonAttributes(),
                'columnSelectMenuOptionCheckboxAttributes' => $this->getColumnSelectMenuOptionCheckboxAttributes(),
                'selectableSelectedColumnCount' => $this->getSelectableSelectedColumns()->count(),
                'jsoned' => json_encode(array_keys($this->selectableColumns)),
            ]];
        }
        return [];
    }

    protected function getToolbarItemForPaginationDropdown()
    {
        if($this->showPaginationDropdown())
        {
            return ['view' => 'livewire-tables::includes.toolbar.items.pagination-dropdown', 'attributes' => [
                'perPageFieldAttributes' => $this->getPerPageFieldAttributes(),
            ]];
        }
        return [];
    }

    protected function getToolbarItemForBulkActions()
    {
        if ($this->showBulkActionsDropdownAlpine() && $this->shouldAlwaysHideBulkActionsDropdownOption() != true)
        {
            return ['view' => 'livewire-tables::includes.toolbar.items.bulk-actions', 'attributes' => [
                'bulkActionsButtonAttributes' => $this->getBulkActionsButtonAttributes(),
                'bulkActionsMenuAttributes' => $this->getBulkActionsMenuAttributes(),

            ]];
        }
        return [];
    }

}