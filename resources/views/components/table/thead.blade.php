@aware(['tableName'])
<x-slot name="thead">

    @if($this->getCurrentlyReorderingStatus())
        <x-livewire-tables::table.th.reorder x-cloak x-show="currentlyReorderingStatus"  />
    @endif
    @if($this->showBulkActionsSections())
        <x-livewire-tables::table.th.bulk-actions :displayMinimisedOnReorder="true" />
    @endif
    @if ($this->showCollapsingColumnSections())
        <x-livewire-tables::table.th.collapsed-columns />
    @endif

    @tableloop($this->selectedVisibleColumns() as $index => $column)
        <x-livewire-tables::table.th wire:key="{{ $tableName.'-table-head-'.$index }}" :$column :$index />
    @endtableloop
</x-slot>
