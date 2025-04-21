@props(['component', 'isTailwind', 'isTailwind4', 'isBootstrap','isBootstrap4', 'isBootstrap5', 'tableName', 'primaryKey', 'collapsingColumnDetails', 'tdAttributes', 'tdCheckboxAttributes', 'collapsingColumnButtonExpandAttributes', 'collapsingColumnButtonCollapseAttributes', 'hasCollapsingColumns', 'shouldCollapseAlways', 'shouldCollapseOnTablet', 'shouldCollapseOnMobile', 'collapsingColumnClasses', 'currentlyReorderingStatus', 'hasDisplayLoadingPlaceholder', 'coreTableAttributes', 'selectedVisibleColumns', 'showBulkActionsSections', 'showCollapsingColumnSections', 'hasTrAttributes'])
<div wire:key="{{ $tableName }}-wrapper" >
    <div {{ $attributes->merge($this->getComponentWrapperAttributes()) }}
        @if ($this->hasRefresh()) wire:poll{{ $this->getRefreshOptions() }} @endif
        @if ($this->isFilterLayoutSlideDown()) wire:ignore.self @endif>

        <div>
        @if ($this->debugIsEnabled())
            @include('livewire-tables::includes.debug')
        @endif
        @if ($this->offlineIndicatorIsEnabled())
            @include('livewire-tables::includes.offline')
        @endif

            {{ $slot }}
        </div>
    </div>
</div>
