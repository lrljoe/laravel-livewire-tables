<?php

namespace Rappasoft\LaravelLivewireTables;

use Livewire\Attributes\On;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Traits\HasAllTraits;

abstract class DataTableComponent extends Component
{
    use HasAllTraits;

    /**
     * Runs on every request, immediately after the component is instantiated, but before any other lifecycle methods are called
     * Called when refreshDatatable is called as an event
     */
    #[On('refreshDatatable')]
    public function boot(): void
    {
        //
    }

    /**
     * Runs on every request, after the component is mounted or hydrated, but before any update methods are called
     */
    public function booted(): void {}

    public function render(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        // dd($this->getCollapsedColumnsForContentNew());
        /*
        [
            "shouldCollapseAlways" => false
    "shouldCollapseOnTablet" => true
    "shouldCollapseOnMobile" => false
    "isHtml" => false
    "title" => "Created At"
    ]*/

        return view('livewire-tables::datatable')->with(
            [
                'tableName' => $this->getTableName(),
                'tableId' => $this->getTableId(),
                'primaryKey' => $this->getPrimaryKey(),
                'localisationPath' => $this->getLocalisationPath(),
                'getCurrentlyReorderingStatus' => $this->getCurrentlyReorderingStatus(),
                'showBulkActionsSections' => $this->showBulkActionsSections(),
                'showCollapsingColumnSections' => $this->showCollapsingColumnSections(),
                'selectedVisibleColumns' => $this->selectedVisibleColumns(),
                'collapsingColumnDetails' => $this->getCollapsedColumnsForContentNew(),
                'tdAttributes' => $this->getBulkActionsTdAttributes(),
                'tdCheckboxAttributes' => $this->getBulkActionsTdCheckboxAttributes(),
                'collapsingColumnButtonExpandAttributes' => $this->getCollapsingColumnButtonExpandAttributes(),
                'collapsingColumnButtonCollapseAttributes' => $this->getCollapsingColumnButtonCollapseAttributes(),
                'hasCollapsingColumns' => ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns()),
                'shouldCollapseAlways' => $this->shouldCollapseAlways(),
                'shouldCollapseOnTablet' => $this->shouldCollapseOnTablet(),
                'shouldCollapseOnMobile' => $this->shouldCollapseOnMobile(),
                'collapsingColumnClasses' => $this->getCollapsingColumnClasses(),
                'hasDisplayLoadingPlaceholder' => $this->hasDisplayLoadingPlaceholder(),
                'coreTableAttributes' => $this->getCoreTableAttributes(),
                'isTailwind' => $this->isTailwind(),
                'isTailwind4' => $this->isTailwind4(),
                'isBootstrap' => $this->isBootstrap(),
                'isBootstrap4' => $this->isBootstrap4(),
                'isBootstrap5' => $this->isBootstrap5(),
                'hasTrAttributes' => $this->hasTrAttributes(),
            ]
        );
    }
}
