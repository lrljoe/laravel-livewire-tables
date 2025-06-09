<?php

namespace Rappasoft\LaravelLivewireTables\Features\Tools;

use Rappasoft\LaravelLivewireTables\Features\Tools\Configuration\ToolBarConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Tools\Helpers\ToolBarHelpers;
use Rappasoft\LaravelLivewireTables\Features\Tools\Styling\HasToolBarStyling;
use Rappasoft\LaravelLivewireTables\Features\Tools\Helpers\ToolBarItemHelpers;
use Livewire\Attributes\Computed;

trait WithToolBar
{
    use ToolBarConfiguration,
        ToolBarHelpers,
        ToolBarItemHelpers,
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
    protected array $toolBarItems = ['left' => [], 'right' => []];

    protected array $toolBarDefaultItems = ['left' => ['reorder','search','filters'], 'right' => ['bulk-actions','column-select','pagination-dropdown']];

    public function toolbarItemsLeft()
    {
        return ['reorder','search','filters'];
    }

    public function toolbarItemsRight()
    {
        return ['bulk-actions','column-select','pagination-dropdown'];
    }
    
    #[Computed]
    public function getLeftToolbarItems()
    {
        return $this->toolBarItems['left'];
    }

    #[Computed]
    public function getRightToolbarItems()
    {
        return $this->toolBarItems['right'];
    }

    public function renderingWithToolBar()
    {
        if($this->toolBarItems == ['left' => [], 'right' => []])
        {
            $this->setupToolbarItems();
        }
    }

}