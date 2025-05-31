@aware(['tableName','primaryKey'])
@props(['bulkActionsTdAttributes','bulkActionsTdCheckboxAttributes', 'currentRows'])

<x-livewire-tables::table.main>
    <x-livewire-tables::thead />

    @if(count($currentRows) > 0)
        @tableloop ($currentRows as $rowIndex => $row)
            @php($rowPk = $row->{$primaryKey})
            <x-livewire-tables::tbody wire:key="{{ $tableName }}-row-wrap-{{ $rowPk }}" :$row :$rowIndex :$rowPk :tableRowDetails="$this->getTableRowDetails($row, $rowIndex)" />
        @endtableloop
    @else
        <x-livewire-tables::table.empty />
    @endif
        
    <x-livewire-tables::tfoot />

</x-livewire-tables::table.main>
