@aware(['dataTableFingerprint','primaryKey','isTailwind', 'isTailwind4', 'isBootstrap', 'localisationPath', 'coreTableAttributes', 'selectedVisibleColumns'])
@props(['bulkActionsTdAttributes','bulkActionsTdCheckboxAttributes'])

<table {{ $attributes->merge($coreTableAttributes['table'])
        ->class([
            'rappasoft-livewire-table-new' => $isTailwind,
            'divide-gray-200 dark:divide-none' => $isTailwind && ($coreTableAttributes['table']['default-colors'] ?? ($coreTableAttributes['table']['default'] ?? true)),
            'min-w-full divide-y' => $isTailwind && ($coreTableAttributes['table']['default-styling'] ?? ($coreTableAttributes['table']['default'] ?? true)),
            
            'tw4ph rappasoft-livewire-table-new' => $isTailwind4,
            'tw4ph divide-gray-200 dark:divide-none' => $isTailwind4 && ($coreTableAttributes['table']['default-colors'] ?? ($coreTableAttributes['table']['default'] ?? true)),
            'tw4ph min-w-full divide-y' => $isTailwind4 && ($coreTableAttributes['table']['default-styling'] ?? ($coreTableAttributes['table']['default'] ?? true)),

            '' => $isBootstrap && ($coreTableAttributes['table']['default-colors'] ?? ($coreTableAttributes['table']['default'] ?? true)),
            'laravel-livewire-table table' => $isBootstrap && ($coreTableAttributes['table']['default-styling'] ?? ($coreTableAttributes['table']['default'] ?? true)),
        ])
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
                <x-livewire-tables::tbody wire:key="{{ $dataTableFingerprint }}-row-wrap-{{ $rowPk }}" :$row :$rowIndex :$rowPk :tableRowDetails="$this->getTableRowDetails($row, $rowIndex)" />
            @endtableloop
        @else
            <x-livewire-tables::table.empty />
        @endif
            
        <x-livewire-tables::tfoot />

    @endif
</table>
