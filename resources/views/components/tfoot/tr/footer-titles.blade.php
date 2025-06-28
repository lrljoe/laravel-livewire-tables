@aware(['dataTableFingerprint','isTailwind', 'isTailwind4', 'isBootstrap', 'currentlyReorderingStatus', 'showBulkActionsSections', 'showCollapsingColumnSections','selectedVisibleColumns'])

<x-livewire-tables::table.tr.plain :rowIndex="-1" data-id="tfoot"
    :customAttributes="$this->getFooterTrAttributes($this->getRows)"
    wire:key="{{ $dataTableFingerprint .'-footer' }}"
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
        <x-livewire-tables::table.th wire:key="{{ $dataTableFingerprint.'-table-foot-'.$index }}" :$column :$index />
    @endtableloop
</x-livewire-tables::table.tr.plain>