<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait TableAttributeHelpers
{
    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getCoreTableAttributes(): array
    {
        return [
            'wrapper' => $this->getTableWrapperAttributes(),
            'table' => $this->getTableAttributes(),
            'thead' => $this->getTheadAttributes(),
            'tbody' => $this->getTbodyAttributes(),
        ];
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getComponentWrapperAttributes(): array
    {
        $coreAttribs = [
            'id' => 'datatable-'.$this->getId(),
            'wire:key' => $this->getTableName() . '-wrapper',
        ];

        if ($this->hasRefresh())
        {
            $coreAttribs['wire:poll'.$this->getRefreshOptions()] = '';
        }
        if($this->isFilterLayoutSlideDown())
        {
            $coreAttribs['wire:ignore.self'] = '';
        }

        return([
            ...$coreAttribs, 
        ...$this->componentWrapperAttributes]);
    }

    public function getBulkActionsAlpine()
    {  
        $coreAttribs = [];
        if($this->showBulkActionsSections())
        {
            return new ComponentAttributeBag([
                'x-data' => 'bulkactions($wire)',
                'x-show' => 'selectedItems.length > 0 && !currentlyReorderingStatus',
            ]);
        }
        return new ComponentAttributeBag($coreAttribs);
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getTableWrapperAttributes(): array
    {
        return array_merge([
            'wire:key' => $this->getTableName().'-twrap'
        ], (count($this->tableWrapperAttributes) ? $this->tableWrapperAttributes : ['default' => true]));
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getTableAttributes(): array
    {
        return array_merge(
            [
                'wire:key' => $this->getTableName().'-table',
                'id' => 'table-'.$this->getTableName(),
            ], 
            $this->getCurrentlyReorderingStatus() ? [
                'x-sort' => '',
                'x-sort:config' => "{ 
                    group: 'table-".$this->getTableName()."',
                    filter: '.unsortable',
                    onMove: function (e) { 
                        return e.related.className.indexOf('unsortable') === -1;  
                    },
                    store: {
                        /**
                        * Save the order of elements. Called onEnd (when the item is dropped).
                        * @param {Sortable}  sortable
                        */
                        set: function (sortable) {
                            var order = sortable.toArray();
                            const result = order.filter((word) => (word !== 'thead' && word !== 'tfoot' && word !== 'loading'));
                            updateOrderOfItems(result);
                        }
                    } 
                }",                
            ] : [],
            (count($this->tableAttributes) ? $this->tableAttributes : ['default' => true])
        );
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getTheadAttributes(): array
    {
        return array_merge(['wire:key' => $this->getTableName().'-thead'], (count($this->theadAttributes) ? $this->theadAttributes : ['default' => true]));
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getTbodyAttributes(): array
    {
        return array_merge(['wire:key' => $this->getTableName().'-tbody'], (count($this->tbodyAttributes) ? $this->tbodyAttributes : ['default' => true]));
    }

    /**
     * Used in resources/views/components/table/th.blade.php
     *
     * @param Column $column
     * @return array<mixed>
     */
    public function getThAttributes(Column $column): array
    {

        if (isset($this->thAttributesCallback)) {
            return array_merge(['scope' => 'col', 'default' => false, 'default-colors' => false, 'default-styling' => false], call_user_func($this->thAttributesCallback, $column));
        }

        return ['default' => true, 'default-colors' => true, 'default-styling' => true];
    }

    /**
     * Undocumented function
     *
     * Used in resources/views/components/table/th.blade.php
     * 
     * @param Column $column
     * @return array<mixed>
     */
     public function getThSortButtonAttributes(Column $column): array
    {
        if (isset($this->thSortButtonAttributesCallback)) {
            return array_merge(['default' => false, 'default-colors' => false, 'default-styling' => false], call_user_func($this->thSortButtonAttributesCallback, $column));
        }

        return ['default' => true, 'default-colors' => true, 'default-styling' => true];
    }


    /**
     * Undocumented function
     *
     *  Used in resources/views/components/table/th.blade.php
     * 
     * @param Column $column
     * @return array<mixed>
     */
     public function getThSortIconAttributes(Column $column): array
    {
        if (isset($this->thSortIconAttributesCallback)) {
            return array_merge(['default' => false, 'default-colors' => false, 'default-styling' => false], call_user_func($this->thSortIconAttributesCallback, $column));
        }

        return ['default' => true, 'default-colors' => true, 'default-styling' => true];
    }

    
    /**
     * Undocumented function
     * Used in resources/views/components/table/th.blade.php
     * @param Column $column
     * @return array<mixed>
     */
     public function getAllThAttributes(Column $column): array
    {
        return [
            'customAttributes' => $this->getThAttributes($column),
            'labelAttributes' => $column->getLabelAttributesBag(),
            'sortButtonAttributes' => $this->getThSortButtonAttributes($column),
            'sortIconAttributes' => $this->getThSortIconAttributes($column),
        ];
    }

    public function hasTrAttributes(): bool
    {
        return isset($this->trAttributesCallback);
    }

    /**
     * Undocumented function
     *
     * @param Model $row
     * @param integer $index
     * @return array<mixed>
     */
    public function getTrAttributes(Model $row, int $index): array
    {
        return isset($this->trAttributesCallback) ? call_user_func($this->trAttributesCallback, $row, $index) : ['default' => true];
    }

    /**
     * Undocumented function
     *
     * @param Column $column
     * @param Model $row
     * @param integer $colIndex
     * @param integer $rowIndex
     * @return array<mixed>
     */
    public function getTdAttributes(Column $column, Model $row, int $colIndex, int $rowIndex): array
    {
        return isset($this->tdAttributesCallback) ? call_user_func($this->tdAttributesCallback, $column, $row, $colIndex, $rowIndex) : ['default' => true];
    }
    
    public function hasTdAttributes(): bool
    {
        return isset($this->tdAttributesCallback);
    }

    public function hasTableRowUrl(): bool
    {
        return isset($this->trUrlCallback);
    }

    public function getTableRowUrl(int|Model $row): ?string
    {
        return isset($this->trUrlCallback) ? call_user_func($this->trUrlCallback, $row) : null;
    }

    public function getTableRowUrlTarget(int|Model $row): ?string
    {
        return isset($this->trUrlTargetCallback) ? call_user_func($this->trUrlTargetCallback, $row) : null;
    }

    #[Computed]
    public function getShouldBeDisplayed(): bool
    {
        return $this->shouldBeDisplayed;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getTopLevelAttributesArray(): array
    {
        return [
            'x-data' => 'laravellivewiretable($wire)',
            'x-init' => "setTableId('".$this->getTableAttributes()['id']."'); setPrimaryKeyName('".$this->getPrimaryKey()."');",
            'x-cloak' => '',
            'x-show' => 'shouldBeDisplayed',
            'x-on:show-table.window' => 'showTable(event)',
            'x-on:hide-table.window' => 'hideTable(event)',
        ];
    }

    #[Computed]
    public function getTopLevelAttributes(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getTopLevelAttributesArray());
    }

    /**
     * Adds Default Custom Data to the Table View
     *
     * @return array<mixed>
     */
    protected function getDefaultViewCustomData(): array
    {
        return [
            'tableName' => $this->getTableName(),
            'tableId' => $this->getTableId(),
            'primaryKey' => $this->getPrimaryKey(),
            'collapsingColumnInfo' => $this->getCollapsingColumnDetailsForView(),
            'filterGenericData' => $this->getFilterGenericData(),

            'collapsingColumnClasses' => $this->getCollapsingColumnClasses(),
            'collapsingColumnDetails' => $this->getCollapsedColumnsForContentNew(),
            'collapsingColumnButtonExpandAttributes' => $this->getCollapsingColumnButtonExpandAttributes(),
            'collapsingColumnButtonCollapseAttributes' => $this->getCollapsingColumnButtonCollapseAttributes(),
            'hasCollapsingColumns' => ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns()),
            'showCollapsingColumnSections' => $this->showCollapsingColumnSections(),
            'shouldCollapseAlways' => $this->shouldCollapseAlways(),
            'shouldCollapseOnTablet' => $this->shouldCollapseOnTablet(),
            'shouldCollapseOnMobile' => $this->shouldCollapseOnMobile(),

            'coreTableAttributes' => $this->getCoreTableAttributes(),
            
            'getCurrentlyReorderingStatus' => $this->getCurrentlyReorderingStatus(),

            'hasDisplayLoadingPlaceholder' => $this->hasDisplayLoadingPlaceholder(),
            'hasTrAttributes' => $this->hasTrAttributes(),

            'isBootstrap' => $this->isBootstrap(),
            'isBootstrap4' => $this->isBootstrap4(),
            'isBootstrap5' => $this->isBootstrap5(),
            'isTailwind' => $this->isTailwind(),
            'isTailwind4' => $this->isTailwind4(),            

            'localisationPath' => $this->getLocalisationPath(),
            
            'selectedVisibleColumns' => $this->selectedVisibleColumns(),
            'showBulkActionsSections' => $this->showBulkActionsSections(),
            'bulkActionsTdAttributes' => $this->getBulkActionsTdAttributes(),
            'bulkActionsTdCheckboxAttributes' => $this->getBulkActionsTdCheckboxAttributes(),
        ];
    }

    /**
     * Undocumented function
     *
     * @param Model $row
     * @param integer $rowIndex
     * @return array<mixed>
     */
    public function getTableRowDetails(Model $row, int $rowIndex): array
    {
        $url = isset($this->trUrlCallback) ? call_user_func($this->trUrlCallback, $row) : null;
        $target = isset($this->trUrlTargetCallback) ? call_user_func($this->trUrlTargetCallback, $row) : null;

        return [
            'attributes' => $this->getTrAttributes($row, $rowIndex),
            'url' => $url,
            'target' => $target,
            'tdAttribs' => ($target == 'navigate' ? ['wire:navigate' => '','href' => $url] : ['onclick' => "window.open('".$url."', '".$target."')"]),
        ];


    }

    /**
     * Undocumented function
     *
     * @param Column $column
     * @param Model $row
     * @param integer $colIndex
     * @param integer $rowIndex
     * @param array<mixed> $tableRowDetails
     * @return array<mixed>
     */
    public function getTdAttributesNew(Column $column, Model $row, int $colIndex, int $rowIndex, array $tableRowDetails = []): array
    {
        $tdAttribs = isset($this->tdAttributesCallback) ? call_user_func($this->tdAttributesCallback, $column, $row, $colIndex, $rowIndex) : ['default' => true];
        if($column->isClickable() && !empty($tableRowDetails))
        {   
            if($tableRowDetails['target'] === 'navigate') 
            {
                $tdAttribs['wire:navigate'] = '';
                $tdAttribs['href'] = $tableRowDetails['url'];
            }
            else
            {
                $tdAttribs['onclick'] = "window.open('".$tableRowDetails['url']."', '".$tableRowDetails['target']."')";

            }
    
        }

        return $tdAttribs;
    }


}
