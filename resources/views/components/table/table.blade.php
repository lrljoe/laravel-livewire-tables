@aware(['dataTableFingerprint','primaryKey','isTailwind', 'isTailwind4', 'isBootstrap', 'localisationPath', 'coreTableAttributes', 'selectedVisibleColumns', 'selectedVisibleColumnsData'])
@props(['bulkActionsTdAttributes','bulkActionsTdCheckboxAttributes'])

<table {{ $attributes->merge($coreTableAttributes['table'])
        ->class($isTailwind ? [
            'rappasoft-livewire-table-new',
            'divide-gray-200 dark:divide-none' => ($attributes['default-colors'] ?? ($attributes['default'] ?? true)),
            'min-w-full divide-y' => ($attributes['default-styling'] ?? ($attributes['default'] ?? true)),
        ] : [])
        ->class($isTailwind4 ? [
            'rappasoft-livewire-table-new',
            'divide-gray-200 dark:divide-none' => ($attributes['default-colors'] ?? ($attributes['default'] ?? true)),
            'min-w-full divide-y' => ($attributes['default-styling'] ?? ($attributes['default'] ?? true)),
        ] : [])
        ->class($isBootstrap ? [
            '' => ($attributes['default-colors'] ?? ($attributes['default'] ?? true)),
            'laravel-livewire-table table' => ($attributes['default-styling'] ?? ($attributes['default'] ?? true)),
        ] : [])
        ->except(['default','default-styling','default-colors', 'wire:key']) }}
        wire:key="bookingitemstable-table-{{ rand(5828,458218) }}"
>
    @if(count($selectedVisibleColumns ?? []) == 0)
        <x-livewire-tables::table.no-columns />
    @else
        <x-livewire-tables::thead />


            @php($currentRows = $this->getRows)

            @if(count($currentRows) > 0)
                @tableloop ($currentRows as $rowIndex => $row)
                        @php($rowPk = $row->{$primaryKey})
                        <x-livewire-tables::tbody wire:key="{{ $dataTableFingerprint }}-row-wrap-{{ $rowPk }}" :$rowIndex :$rowPk :tableRowDetails="$this->getTableRowDetails($row, $rowIndex)">

                        @tableloop($selectedVisibleColumns as $colIndex => $column)
                            @php($columnTdArray = $selectedVisibleColumnsData[$column->setIndexes($rowIndex, $colIndex)->getHash()])
                            <x-livewire-tables::table.td x-ref="{{ $dataTableFingerprint . '_' . $rowIndex . '_' . $colIndex }}"
                                :$columnTdArray
                                :customAttributes="$columnTdArray['hasTdAttributesCallback'] ? $this->getTdAttributes($column, $row, $colIndex, $rowIndex) : ['default' => true, 'default-colors' => true, 'default-styling' => true]" 
                                :$colIndex  
                                wire:key="{{ $dataTableFingerprint . '-table-td-'.$rowPk.'-'.$columnTdArray['slug'] }}"  
                                
                            >
                                @if($columnTdArray['isHtml'])
                                    {!! $column->renderContents($row) !!}
                                @else
                                    {{ $column->renderContents($row) }}
                                @endif
                            </x-livewire-tables::table.td>
                        @endtableloop
                        </x-livewire-tables::tbody>
                @endtableloop
            @else
                <x-livewire-tables::table.empty />
            @endif

        <x-livewire-tables::tfoot />

    @endif
</table>
