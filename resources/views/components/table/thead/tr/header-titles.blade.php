@aware(['tableName','isTailwind', 'isTailwind4', 'isBootstrap', 'currentlyReorderingStatus', 'showBulkActionsSections', 'showCollapsingColumnSections','selectedVisibleColumns'])

<x-livewire-tables::table.tr.plain :rowIndex="-1" data-id="thead"
    :customAttributes="$this->getHeaderTrAttributes($this->getRows)"
    wire:key="{{ $tableName .'-header' }}"
>
    @if($currentlyReorderingStatus)
        <x-livewire-tables::table.th.reorder  />
    @endif
    @if(!$currentlyReorderingStatus && $showBulkActionsSections)
        <x-livewire-tables::table.th.bulk-actions :displayMinimisedOnReorder="true" />
    @endif
    @if ($showCollapsingColumnSections)
        <x-livewire-tables::table.th.collapsed-columns />
    @endif

    @tableloop($selectedVisibleColumns as $index => $column)
        <x-livewire-tables::table.th wire:key="{{ $tableName.'-table-head-'.$index }}" :$column :$index />
    @endtableloop

</x-livewire-tables::table.tr.plain>