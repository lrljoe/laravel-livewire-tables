@aware(['dataTableFingerprint','isTailwind', 'isTailwind4', 'isBootstrap', 'currentlyReorderingStatus', 'showBulkActionsSections', 'showCollapsingColumnSections','selectedVisibleColumns'])


<x-livewire-tables::table.tr.plain :rowIndex="-1" data-id="thead" x-data=""
    :customAttributes="$this->getHeaderTrAttributes($this->getRows)"
    wire:key="{{ $dataTableFingerprint .'-header' }}"
>
    @if($currentlyReorderingStatus)
        <x-livewire-tables::reorder.th  />
    @else
        @if($showBulkActionsSections)
            <x-livewire-tables::bulk-actions.th :displayMinimisedOnReorder="true" />
        @endif
        @if ($showCollapsingColumnSections)
            <x-livewire-tables::collapsed-columns.th />
        @endif 
    @endif
    
    @tableloop($this->selectedVisibleColumnsRaw as $index => $column)
        <x-livewire-tables::table.th wire:key="{{ $dataTableFingerprint.'-table-head-'.$column['slug'] }}" :columnHash="$column['hash'] ?? 'ran'" :$index />
    @endtableloop

</x-livewire-tables::table.tr.plain>