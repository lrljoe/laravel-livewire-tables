@php($currentlyReorderingStatus = $this->getCurrentlyReorderingStatus())
@php($hasTdAttributes = $this->hasTdAttributes())
<div x-data="{ currentlyReorderingStatus: false }">
    <div {{ $this->getTopLevelAttributes() }}>
        @includeWhen(
            $this->hasConfigurableAreaFor('before-wrapper'),
            $this->getConfigurableAreaFor('before-wrapper'),
            $this->getParametersForConfigurableArea('before-wrapper')
        )

        <x-livewire-tables::wrapper :$tableName :$primaryKey :$isTailwind :$isTailwind4 :$isBootstrap :$isBootstrap4 :$isBootstrap5 :$localisationPath :$collapsingColumnDetails  :$collapsingColumnButtonExpandAttributes :$collapsingColumnButtonCollapseAttributes :$hasCollapsingColumns :$currentlyReorderingStatus :$hasDisplayLoadingPlaceholder :$coreTableAttributes :$selectedVisibleColumns :$showBulkActionsSections :$showCollapsingColumnSections :$hasTrAttributes :$collapsingColumnInfo :$filterGenericData :$hasTdAttributes >
            @if($this->hasActions() && !$this->showActionsInToolbar())
                <x-livewire-tables::includes.actions/>
            @endif

            @if($this->shouldShowTools())
                        
                @includeWhen(
                    $this->hasConfigurableAreaFor('before-tools'),
                    $this->getConfigurableAreaFor('before-tools'),
                    $this->getParametersForConfigurableArea('before-tools')
                )

                <x-livewire-tables::tools :toolsAttributes="$this->getToolsAttributes()" :toolBarAttributes="$this->getToolBarAttributesBag()" />


                @includeWhen(
                    $this->hasConfigurableAreaFor('after-tools'),
                    $this->getConfigurableAreaFor('after-tools'),
                    $this->getParametersForConfigurableArea('after-tools')
                )
                
            @endif

            @php($currentRows = isset($rows) ? $rows : $this->getRows)

            <x-livewire-tables::table.wrapper>
                <x-livewire-tables::table :$bulkActionsTdAttributes :$bulkActionsTdCheckboxAttributes :$currentRows />
            </x-livewire-tables::table.wrapper>

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
