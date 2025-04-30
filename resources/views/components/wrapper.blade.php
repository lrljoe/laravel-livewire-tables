@props(['component', 'isTailwind', 'isTailwind4', 'isBootstrap','isBootstrap4', 'isBootstrap5', 'tableName', 'primaryKey', 'collapsingColumnDetails', 'tdAttributes', 'tdCheckboxAttributes', 'collapsingColumnButtonExpandAttributes', 'collapsingColumnButtonCollapseAttributes', 'hasCollapsingColumns', 'currentlyReorderingStatus', 'hasDisplayLoadingPlaceholder', 'coreTableAttributes', 'selectedVisibleColumns', 'showBulkActionsSections', 'showCollapsingColumnSections', 'hasTrAttributes', 'collapsingColumnInfo', 'filterGenericData'])
<div wire:key="{{ $tableName }}-wrapper" >
    <div {{ $attributes
            ->merge($this->getComponentWrapperAttributes())
            ->merge($this->hasRefresh() ? [
                'wire:poll'.$this->getRefreshOptions() => '',
            ] : [])
            ->merge($this->isFilterLayoutSlideDown() ? [
                'wire:ignore.self'  => '',
            ] : [])
        }}>

        <div>
            @includeWhen($this->debugIsEnabled(),'livewire-tables::includes.debug')
            @includeWhen($this->offlineIndicatorIsEnabled(),'livewire-tables::includes.offline')
            {{ $slot }}
        </div>
    </div>
</div>
