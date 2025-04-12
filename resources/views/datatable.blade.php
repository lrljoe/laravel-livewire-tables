@php($tableName = $this->getTableName)
@php($tableId = $this->getTableId)
@php($primaryKey = $this->getPrimaryKey)
@php($isTailwind = $this->isTailwind)
@php($isBootstrap = $this->isBootstrap)
@php($isBootstrap4 = $this->isBootstrap4)
@php($isBootstrap5 = $this->isBootstrap5)
@php($localisationPath = $this->getLocalisationPath)
@php($getCurrentlyReorderingStatus = $this->getCurrentlyReorderingStatus)
@php($currentlyReorderingStatus = $this->getCurrentlyReorderingStatus)
@php($showBulkActionsSections = $this->showBulkActionsSections)
@php($showCollapsingColumnSections = $this->showCollapsingColumnSections)
@php($selectedVisibleColumns = $this->selectedVisibleColumns)
@php($collapsingColumnDetails = $this->getCollapsedColumnsForContentNew())
@php($tdAttributes = $this->getBulkActionsTdAttributes())
@php($tdCheckboxAttributes = $this->getBulkActionsTdCheckboxAttributes())
@php($collapsingColumnButtonExpandAttributes = $this->getCollapsingColumnButtonExpandAttributes())
@php($collapsingColumnButtonCollapseAttributes = $this->getCollapsingColumnButtonCollapseAttributes())
@php($hasCollapsingColumns = ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns()))
@php($shouldCollapseAlways = $this->shouldCollapseAlways())
@php($shouldCollapseOnTablet = $this->shouldCollapseOnTablet())
@php($shouldCollapseOnMobile = $this->shouldCollapseOnMobile())


<div>
    <div x-data="{ currentlyReorderingStatus: false }">
        <div {{ $this->getTopLevelAttributes() }}>

            @includeWhen(
                $this->hasConfigurableAreaFor('before-wrapper'),
                $this->getConfigurableAreaFor('before-wrapper'),
                $this->getParametersForConfigurableArea('before-wrapper')
            )

            <x-livewire-tables::wrapper :$tableName :$primaryKey :$isTailwind :$isBootstrap :$isBootstrap4 :$isBootstrap5 :$localisationPath :$collapsingColumnDetails :$tdAttributes :$tdCheckboxAttributes :$collapsingColumnButtonExpandAttributes :$collapsingColumnButtonCollapseAttributes :$hasCollapsingColumns :$shouldCollapseAlways :$shouldCollapseOnTablet :$shouldCollapseOnMobile>
                @if($this->hasActions() && !$this->showActionsInToolbar())
                    <x-livewire-tables::includes.actions/>
                @endif

                @includeWhen(
                    $this->hasConfigurableAreaFor('before-tools'),
                    $this->getConfigurableAreaFor('before-tools'),
                    $this->getParametersForConfigurableArea('before-tools')
                )

                @if($this->shouldShowTools())
                    <x-livewire-tables::tools >
                        @if ($this->showSortPillsSection())
                            <x-livewire-tables::tools.sorting-pills />
                        @endif
                        @if($this->showFilterPillsSection())
                            <x-livewire-tables::tools.filter-pills />
                        @endif

                        @includeWhen(
                            $this->hasConfigurableAreaFor('before-toolbar'),
                            $this->getConfigurableAreaFor('before-toolbar'),
                            $this->getParametersForConfigurableArea('before-toolbar')
                        )

                        @if($this->shouldShowToolBar())
                            <x-livewire-tables::tools.toolbar />
                        @endif
                        @if (
                            $this->filtersAreEnabled() &&
                            $this->filtersVisibilityIsEnabled() &&
                            $this->hasVisibleFilters() &&
                            $this->isFilterLayoutSlideDown()
                        )
                            <x-livewire-tables::tools.toolbar.items.filter-slidedown  />
                        @endif
                        @includeWhen(
                            $this->hasConfigurableAreaFor('after-toolbar'),
                            $this->getConfigurableAreaFor('after-toolbar'),
                            $this->getParametersForConfigurableArea('after-toolbar')
                        )

                    </x-livewire-tables::tools>
                @endif

                @includeWhen(
                    $this->hasConfigurableAreaFor('after-tools'),
                    $this->getConfigurableAreaFor('after-tools'),
                    $this->getParametersForConfigurableArea('after-tools')
                )

                <x-livewire-tables::table :bulkActionsTdAttributes="$this->getBulkActionsTdAttributes" :bulkActionsTdCheckboxAttributes="$this->getBulkActionsTdCheckboxAttributes">

                    <x-livewire-tables::table.thead />

                    @if($this->shouldShowSecondaryHeader)
                        <x-livewire-tables::table.tr.secondary-header  />
                    @endif

                    @if($this->hasDisplayLoadingPlaceholder())
                        <x-livewire-tables::includes.loading colCount="{{ $this->columns->count()+1 }}" />
                    @endif

                    @if($showBulkActionsSections)
                        <x-livewire-tables::table.tr.bulk-actions  :displayMinimisedOnReorder="true" />
                    @endif
                    @if(count($currentRows = $this->getRows) > 0)

                        @tableloop ($currentRows as $rowIndex => $row)
                            @php($rowPk = $row->{$primaryKey})
                            <x-livewire-tables::table.tbody wire:key="{{ $tableName }}-row-wrap-{{ $rowPk }}" :$row :$rowIndex :$rowPk />
                            
                        @endtableloop
                    @else
                        <x-livewire-tables::table.empty />
                    @endif
                    

                    @if ($this->shouldShowFooter)
                        <x-livewire-tables::table.tfoot />
                    @endif
                </x-livewire-tables::table>

                <x-livewire-tables::pagination :$currentRows />

                @includeIf($customView)
            </x-livewire-tables::wrapper>

            @includeWhen(
                $this->hasConfigurableAreaFor('after-wrapper'),
                $this->getConfigurableAreaFor('after-wrapper'),
                $this->getParametersForConfigurableArea('after-wrapper')
            )

        </div>
    </div>
</div>
