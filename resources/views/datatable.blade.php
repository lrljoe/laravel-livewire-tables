@php($currentlyReorderingStatus = $this->getCurrentlyReorderingStatus())

<div>
    
    <div x-data="{ currentlyReorderingStatus: false }">
        <div {{ $this->getTopLevelAttributes() }}>

            @includeWhen(
                $this->hasConfigurableAreaFor('before-wrapper'),
                $this->getConfigurableAreaFor('before-wrapper'),
                $this->getParametersForConfigurableArea('before-wrapper')
            )

            <x-livewire-tables::wrapper :$tableName :$primaryKey :$isTailwind :$isTailwind4 :$isBootstrap :$isBootstrap4 :$isBootstrap5 :$localisationPath :$collapsingColumnDetails :$tdAttributes :$tdCheckboxAttributes :$collapsingColumnButtonExpandAttributes :$collapsingColumnButtonCollapseAttributes :$hasCollapsingColumns :$currentlyReorderingStatus :$hasDisplayLoadingPlaceholder :$coreTableAttributes :$selectedVisibleColumns :$showBulkActionsSections :$showCollapsingColumnSections :$hasTrAttributes :$collapsingColumnInfo :$filterGenericData>
                @if($this->hasActions() && !$this->showActionsInToolbar())
                    <x-livewire-tables::includes.actions/>
                @endif

                @includeWhen(
                    $this->hasConfigurableAreaFor('before-tools'),
                    $this->getConfigurableAreaFor('before-tools'),
                    $this->getParametersForConfigurableArea('before-tools')
                )

                @if($this->shouldShowTools())
                    <x-livewire-tables::tools />
                @endif

                @includeWhen(
                    $this->hasConfigurableAreaFor('after-tools'),
                    $this->getConfigurableAreaFor('after-tools'),
                    $this->getParametersForConfigurableArea('after-tools')
                )
                
                @php($currentRows = isset($rows) ? $rows : $this->getRows)

                <x-livewire-tables::table :bulkActionsTdAttributes="$this->getBulkActionsTdAttributes" :bulkActionsTdCheckboxAttributes="$this->getBulkActionsTdCheckboxAttributes">

        
                    @if(count($currentRows) > 0)
                        @tableloop ($currentRows as $rowIndex => $row)
                            @php($rowPk = $row->{$primaryKey})
                            @php($tableRowDetails = $this->getTableRowDetails($row, $rowIndex))

                            <x-livewire-tables::tbody wire:key="{{ $tableName }}-row-wrap-{{ $rowPk }}" :$row :$rowIndex :$rowPk :$tableRowDetails />
                        @endtableloop
                    @else
                        <x-livewire-tables::table.empty />
                    @endif
                    
                @if($this->hasDisplayLoadingPlaceholder())
                <x-livewire-tables::includes.loading colCount="{{ $this->columns->count()+1 }}" :$loadingPlaceholderDetails/>
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
