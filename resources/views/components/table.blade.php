@aware(['tableName','primaryKey', 'isTailwind', 'isTailwind4', 'isBootstrap', 'currentlyReorderingStatus', 'selectedVisibleColumns','coreTableAttributes', 'rows', 'loadingPlaceholderDetails'])
@props(['bulkActionsTdAttributes','bulkActionsTdCheckboxAttributes', 'currentRows'])

<div {{ $attributes->merge($coreTableAttributes['wrapper'])
        ->class([
            // Tailwind3
            'border-gray-200 dark:border-gray-700' => $isTailwind && ($coreTableAttributes['wrapper']['default-colors'] ?? ($coreTableAttributes['wrapper']['default'] ?? true)),
            'shadow overflow-y-auto border-b sm:rounded-lg' => $isTailwind && ($coreTableAttributes['wrapper']['default-styling'] ?? ($coreTableAttributes['wrapper']['default'] ?? false)),

            // Tailwind4
            'border-gray-200 dark:border-gray-700' => $isTailwind4 && ($coreTableAttributes['wrapper']['default-colors'] ?? ($coreTableAttributes['wrapper']['default'] ?? true)),
            'shadow overflow-y-auto border-b sm:rounded-lg' => $isTailwind4 && ($coreTableAttributes['wrapper']['default-styling'] ?? ($coreTableAttributes['wrapper']['default'] ?? false)),

            // Bootstrap
            '' => $isBootstrap && ($coreTableAttributes['wrapper']['default-colors'] ?? ($coreTableAttributes['wrapper']['default'] ?? true)),
            'table-responsive' => $isBootstrap && ($coreTableAttributes['wrapper']['default-styling'] ?? ($coreTableAttributes['wrapper']['default'] ?? true)),
        ])
        ->except(['default','default-styling','default-colors'])
}}>
    <table 
        {{ $attributes->merge($coreTableAttributes['table'])
            ->class([
                // Tailwind3
                'rappasoft-livewire-table-new' => $isTailwind,
                'divide-gray-200 dark:divide-none' => $isTailwind && ($coreTableAttributes['table']['default-colors'] ?? ($coreTableAttributes['table']['default'] ?? true)),
                'min-w-full divide-y' => $isTailwind && ($coreTableAttributes['table']['default-styling'] ?? ($coreTableAttributes['table']['default'] ?? true)),

                // Tailwind4
                'rappasoft-livewire-table-new' => $isTailwind4,
                'divide-gray-200 dark:divide-none' => $isTailwind4 && ($coreTableAttributes['table']['default-colors'] ?? ($coreTableAttributes['table']['default'] ?? true)),
                'min-w-full divide-y' => $isTailwind4 && ($coreTableAttributes['table']['default-styling'] ?? ($coreTableAttributes['table']['default'] ?? true)),

                // Bootstrap
                '' => $isBootstrap && ($coreTableAttributes['table']['default-colors'] ?? ($coreTableAttributes['table']['default'] ?? true)),
                'laravel-livewire-table table' => $isBootstrap && ($coreTableAttributes['table']['default-styling'] ?? ($coreTableAttributes['table']['default'] ?? true)),
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
