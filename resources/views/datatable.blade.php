@php($currentlyReorderingStatus = $this->getCurrentlyReorderingStatus())

<div>
    
    <div x-data="{ currentlyReorderingStatus: false }">
        <div {{ $this->getTopLevelAttributes() }}>

            @includeWhen(
                $this->hasConfigurableAreaFor('before-wrapper'),
                $this->getConfigurableAreaFor('before-wrapper'),
                $this->getParametersForConfigurableArea('before-wrapper')
            )

            <x-livewire-tables::wrapper :$tableName :$primaryKey :$isTailwind :$isTailwind4 :$isBootstrap :$isBootstrap4 :$isBootstrap5 :$localisationPath :$collapsingColumnDetails :$tdAttributes :$tdCheckboxAttributes :$collapsingColumnButtonExpandAttributes :$collapsingColumnButtonCollapseAttributes :$hasCollapsingColumns :$shouldCollapseAlways :$shouldCollapseOnTablet :$shouldCollapseOnMobile :$collapsingColumnClasses :$currentlyReorderingStatus :$hasDisplayLoadingPlaceholder :$coreTableAttributes :$selectedVisibleColumns :$showBulkActionsSections :$showCollapsingColumnSections :$hasTrAttributes>
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


                    @if($this->hasDisplayLoadingPlaceholder())
                        <x-livewire-tables::includes.loading colCount="{{ $this->columns->count()+1 }}" />
                    @endif

                    @if(count($currentRows = $this->getRows) > 0)

                        @tableloop ($currentRows as $rowIndex => $row)
                            @php($rowPk = $row->{$primaryKey})
                            <x-livewire-tables::table.tbody wire:key="{{ $tableName }}-row-wrap-{{ $rowPk }}" :$row :$rowIndex :$rowPk/>
                            
                        @endtableloop
                    @else
                        <x-livewire-tables::table.empty />
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
