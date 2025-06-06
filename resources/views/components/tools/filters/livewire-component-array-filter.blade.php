<div wire:key="appliedFilters.{{ $filter->getKey() }}-wrapper">
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout />
    <livewire:dynamic-component :is="$livewireComponent" :tableComponent="get_class($this)" :filterKey="$filter->getKey()" :$tableName :key="'appliedFilters-'.$filter->getKey()" wire:model="availableFilters.{{ $filter->getKey() }}" />
</div>
