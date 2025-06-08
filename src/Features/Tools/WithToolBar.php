<?php

namespace Rappasoft\LaravelLivewireTables\Features\Tools;

use Rappasoft\LaravelLivewireTables\Features\Tools\Configuration\ToolBarConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Tools\Helpers\ToolBarHelpers;
use Rappasoft\LaravelLivewireTables\Features\Tools\Styling\HasToolBarStyling;

trait WithToolBar
{
    use ToolBarConfiguration,
        ToolBarHelpers,
        HasToolBarStyling;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $toolBarStatus = true;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $toolBarItems = ['left' => [], 'right' => []];

    public array $toolBarDefaultItems = ['left' => ['reorder','search','filters'], 'right' => ['bulk-actions','column-select','pagination-dropdown']];

    public function mountWithToolBar(): void
    {
    }

    public function toolbarItemsLeft()
    {
        return ['reorder','search','filters'];
    }

    public function toolbarItemsRight()
    {
        return ['bulk-actions','column-select','pagination-dropdown'];
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


    public function renderingWithToolBar()
    {
        if($this->toolBarItems == ['left' => [], 'right' => []])
        {
            $this->setupToolbarItems();
        }
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
            return ['view' => 'livewire-tables::includes.toolbar.items.filter-button',  'attributes' => []];
        }
        return [];
    }

    protected function getToolbarItemForActions()
    {
        return ['view' => 'livewire-tables::includes.toolbar.items.actions',  'attributes' => [
                'actionWrapperAttributes' => $this->getActionWrapperAttributes(),
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
            return ['view' => 'livewire-tables::includes.toolbar.items.bulk-actions', 'attributes' => []];
        }
        return [];
    }

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