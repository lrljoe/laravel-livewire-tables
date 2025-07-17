@props(['component', 'isTailwind' => false, 'isTailwind4' => false, 'isBootstrap' => false,'isBootstrap4' => false, 'isBootstrap5' => false, 'tableName', 'primaryKey', 'collapsingColumnDetails', 'tdAttributes', 'tdCheckboxAttributes', 'collapsingColumnButtonExpandAttributes', 'collapsingColumnButtonCollapseAttributes', 'hasCollapsingColumns', 'currentlyReorderingStatus', 'hasDisplayLoadingPlaceholder', 'coreTableAttributes', 'selectedVisibleColumns', 'showBulkActionsSections', 'showCollapsingColumnSections', 'hasTrAttributes', 'collapsingColumnInfo', 'filterGenericData', 'hasTdAttributes', 'dataTableFingerprint', 'defaultBodyTextAlign'])
<div {{ $attributes->merge($this->getComponentWrapperAttributes()) }}>
    @includeWhen($this->debugIsEnabled(),'livewire-tables::includes.debug')
    @includeWhen($this->offlineIndicatorIsEnabled(),'livewire-tables::includes.offline')

    {{ $slot }}
</div>
