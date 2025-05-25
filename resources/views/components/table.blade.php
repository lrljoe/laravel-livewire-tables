@aware(['tableName','primaryKey', 'isTailwind', 'isTailwind4', 'isBootstrap', 'currentlyReorderingStatus', 'selectedVisibleColumns','coreTableAttributes', 'rows', 'loadingPlaceholderDetails'])
@props(['bulkActionsTdAttributes','bulkActionsTdCheckboxAttributes', 'currentRows'])

<div {{ $attributes->merge($coreTableAttributes['wrapper'])
        ->class($isTailwind ? [
            'border-gray-200 dark:border-gray-700' => $coreTableAttributes['wrapper']['default-colors'] ?? ($coreTableAttributes['wrapper']['default'] ?? false),
            'shadow overflow-y-auto border-b sm:rounded-lg' => $coreTableAttributes['wrapper']['default-styling'] ?? ($coreTableAttributes['wrapper']['default'] ?? false),
        ] :
        [
            '' => $coreTableAttributes['wrapper']['default-colors'] ?? ($coreTableAttributes['wrapper']['default'] ?? true),
            'table-responsive' => $coreTableAttributes['wrapper']['default-styling'] ?? ($coreTableAttributes['wrapper']['default'] ?? true),
        ])
        ->except(['default','default-styling','default-colors'])
}}>
    <table 
        {{ $attributes->merge($coreTableAttributes['table'])
            ->class($isTailwind ? [
                'rappasoft-livewire-table-new',
                'divide-gray-200 dark:divide-none' => $coreTableAttributes['table']['default-colors'] ?? ($coreTableAttributes['table']['default'] ?? true),
                'min-w-full divide-y' => $coreTableAttributes['table']['default-styling'] ?? ($coreTableAttributes['table']['default'] ?? true),
            ] : [
                '' => $coreTableAttributes['table']['default-colors'] ?? ($coreTableAttributes['table']['default'] ?? true),
                'laravel-livewire-table table' => $coreTableAttributes['table']['default-styling'] ?? ($coreTableAttributes['table']['default'] ?? true),
            ])
            ->except(['default','default-styling','default-colors']) }} 
        >
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

    </table>
</div>
