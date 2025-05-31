@props(['component', 'isTailwind', 'isTailwind4', 'isBootstrap','isBootstrap4', 'isBootstrap5', 'tableName', 'primaryKey', 'collapsingColumnDetails', 'tdAttributes', 'tdCheckboxAttributes', 'collapsingColumnButtonExpandAttributes', 'collapsingColumnButtonCollapseAttributes', 'hasCollapsingColumns', 'currentlyReorderingStatus', 'hasDisplayLoadingPlaceholder', 'coreTableAttributes', 'selectedVisibleColumns', 'showBulkActionsSections', 'showCollapsingColumnSections', 'hasTrAttributes', 'collapsingColumnInfo', 'filterGenericData', 'hasTdAttributes'])
<div {{ $attributes->merge($this->getComponentWrapperAttributes()) }}>
    @includeWhen($this->debugIsEnabled(),'livewire-tables::includes.debug')
    @includeWhen($this->offlineIndicatorIsEnabled(),'livewire-tables::includes.offline')
    {{ $slot }}
</div>
