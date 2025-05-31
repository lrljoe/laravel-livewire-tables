@aware(['tableName','isTailwind', 'isTailwind4', 'isBootstrap', 'currentlyReorderingStatus', 'showBulkActionsSections', 'showCollapsingColumnSections','selectedVisibleColumns', 'currentRows'])

<x-livewire-tables::table.tr.plain :rowIndex="-1" data-id="thead"
    :customAttributes="$this->getHeaderTrAttributes($currentRows)"
    wire:key="{{ $tableName .'-header' }}"
>
    @if($currentlyReorderingStatus)
        <x-livewire-tables::reorder.th  />
    @endif
    @if(!$currentlyReorderingStatus && $showBulkActionsSections)
        <x-livewire-tables::bulk-actions.th :displayMinimisedOnReorder="true" />
    @endif
    @if ($showCollapsingColumnSections)
        <x-livewire-tables::collapsed-columns.th />
    @endif

    @tableloop($selectedVisibleColumns as $index => $column)
        <x-livewire-tables::table.th wire:key="{{ $tableName.'-table-head-'.$index }}" :$column :$index />
    @endtableloop

</x-livewire-tables::table.tr.plain>