@props(['component', 'isTailwind' => false, 'isTailwind4' => false, 'isBootstrap' => false,'isBootstrap4' => false, 'isBootstrap5' => false, 'tableName', 'primaryKey', 'collapsingColumnDetails', 'tdAttributes', 'tdCheckboxAttributes', 'collapsingColumnButtonExpandAttributes', 'collapsingColumnButtonCollapseAttributes', 'hasCollapsingColumns', 'currentlyReorderingStatus', 'hasDisplayLoadingPlaceholder', 'coreTableAttributes', 'selectedVisibleColumns', 'showBulkActionsSections', 'showCollapsingColumnSections', 'hasTrAttributes', 'collapsingColumnInfo', 'filterGenericData', 'hasTdAttributes', 'dataTableFingerprint', 'defaultBodyTextAlign', 'sortingIsEnabled', 'columnSortConfig', 'selectedVisibleColumnsData', 'customView'])
<div {{ $attributes->merge($this->getComponentWrapperAttributes()) }}>
    @includeWhen($this->debugIsEnabled(),'livewire-tables::includes.debug')
    @includeWhen($this->offlineIndicatorIsEnabled(),'livewire-tables::includes.offline')

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

        {{ $slot }}
            <x-livewire-tables::pagination />


            @includeIf($customView)

</div>
