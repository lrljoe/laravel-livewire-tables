<div wire:key="appliedFilters.{{ $filter->getKey() }}-wrapper">
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout :$tableName :$isTailwind :$isBootstrap4 :$isBootstrap5 :$isBootstrap />
    <livewire:dynamic-component :is="$livewireComponent" :tableComponent="get_class($this)" :filterKey="$filter->getKey()" :$tableName :key="'appliedFilters-'.$filter->getKey()" wire:model.live="appliedFilters.{{ $filter->getKey() }}" />
</div>
