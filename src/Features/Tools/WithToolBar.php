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

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $toolBarDefaultItems = ['left' => ['reorder','search','filters'], 'right' => ['bulk-actions','column-select','pagination-dropdown']];

    
    /**
     * Get Toolbar Left Items
     *
     * @return array<mixed>
     */
    public function toolbarItemsLeft(): array
    {
        return ['reorder','search','filters'];
    }

    /**
     * Get Toolbar Right Items
     *
     * @return array<mixed>
     */
    public function toolbarItemsRight(): array
    {
        return ['bulk-actions','column-select','pagination-dropdown'];
    }
    

    /**
     * Get Toolbar Left Items
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getLeftToolbarItems(): array
    {
        return $this->toolBarItems['left'];
    }

    /**
     * Get Toolbar Right Items
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getRightToolbarItems(): array
    {
        return $this->toolBarItems['right'];
    }

    public function renderingWithToolBar(): void
    {
        if($this->toolBarItems == ['left' => [], 'right' => []])
        {
            $this->setupToolbarItems();
        }
    }

}