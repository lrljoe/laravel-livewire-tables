<div x-data="{ currentlyReorderingStatus: false }">
    <div {{ $this->getTopLevelAttributes() }}>

        @includeWhen(
            $this->hasConfigurableAreaFor('before-wrapper'),
            $this->getConfigurableAreaFor('before-wrapper'),
            $this->getParametersForConfigurableArea('before-wrapper')
        )

        <x-livewire-tables::wrapper :$tableName :$dataTableFingerprint  :$primaryKey :$isTailwind :$isTailwind4 :$isBootstrap :$isBootstrap4 :$isBootstrap5 :$localisationPath :$collapsingColumnDetails  :$collapsingColumnButtonExpandAttributes :$collapsingColumnButtonCollapseAttributes :$hasCollapsingColumns :$currentlyReorderingStatus :$hasDisplayLoadingPlaceholder :$coreTableAttributes :$selectedVisibleColumns :$showBulkActionsSections :$showCollapsingColumnSections :$hasTrAttributes :$collapsingColumnInfo :$filterGenericData :$hasTdAttributes :$defaultBodyTextAlign :$sortingIsEnabled :$columnSortConfig :$selectedVisibleColumnsData>

            @if($this->shouldShowTools())
                        
                @includeWhen(
                    $this->hasConfigurableAreaFor('before-tools'),
                    $this->getConfigurableAreaFor('before-tools'),
                    $this->getParametersForConfigurableArea('before-tools')
                )

                <x-livewire-tables::tools />


                @includeWhen(
                    $this->hasConfigurableAreaFor('after-tools'),
                    $this->getConfigurableAreaFor('after-tools'),
                    $this->getParametersForConfigurableArea('after-tools')
                )
                
            @endif

            <x-livewire-tables::table.wrapper>
                <x-livewire-tables::table :$bulkActionsTdAttributes :$bulkActionsTdCheckboxAttributes />
            </x-livewire-tables::table.wrapper>

            <x-livewire-tables::pagination />

            @includeIf($customView)

        </x-livewire-tables::wrapper>

        @includeWhen(
            $this->hasConfigurableAreaFor('after-wrapper'),
            $this->getConfigurableAreaFor('after-wrapper'),
            $this->getParametersForConfigurableArea('after-wrapper')
        )
    </div>
</div>
