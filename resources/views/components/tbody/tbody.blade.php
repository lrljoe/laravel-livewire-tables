@aware(['dataTableFingerprint', 'isTailwind', 'isTailwind4', 'isBootstrap', 'coreTableAttributes', 'currentlyReorderingStatus', 'showBulkActionsSections', 'showCollapsingColumnSections', 'selectedVisibleColumns', 'selectedVisibleColumns', 'hasDisplayLoadingPlaceholder', 'hasTdAttributes', 'defaultBodyTextAlign', 'selectedVisibleColumnsData'])
@props(['rowIndex','rowPk', 'tableRowDetails'])

<tbody {{ $attributes->merge($coreTableAttributes['tbody'])
        ->merge($currentlyReorderingStatus ? [
            'x-sort:item' => "'".$rowPk."'",
            'data-id' => $rowPk,
        ] : [])
        ->merge($tableRowDetails['attributes'])
        ->class($isTailwind ? [
            'even:bg-white even:dark:bg-gray-700 odd:bg-gray-50 odd:dark:bg-gray-800 dark:text-white' => ($coreTableAttributes['tbody']['default-colors'] ?? ($coreTableAttributes['tbody']['default'] ?? true)),
            'text-left' => $defaultBodyTextAlign == 'left',
            'text-center' => $defaultBodyTextAlign == 'center',
            'text-right' => $defaultBodyTextAlign == 'right',
            'divide-gray-200 dark:divide-none' => ($coreTableAttributes['tbody']['default-colors'] ?? ($coreTableAttributes['tbody']['default'] ?? true)),
            'divide-y' => ($coreTableAttributes['tbody']['default-styling'] ?? ($coreTableAttributes['tbody']['default'] ?? true)),          
        ] : [])
        ->class($isTailwind4 ? [           
            'even:bg-white even:dark:bg-gray-700 odd:bg-gray-50 odd:dark:bg-gray-800 dark:text-white' => ($coreTableAttributes['tbody']['default-colors'] ?? ($coreTableAttributes['tbody']['default'] ?? true)),
            'text-left' => $defaultBodyTextAlign == 'left',
            'text-center' => $defaultBodyTextAlign == 'center',
            'text-right' => $defaultBodyTextAlign == 'right',
            'divide-gray-200 dark:divide-none' => ($coreTableAttributes['tbody']['default-colors'] ?? ($coreTableAttributes['tbody']['default'] ?? true)),
            'divide-y' => ($coreTableAttributes['tbody']['default-styling'] ?? ($coreTableAttributes['tbody']['default'] ?? true)),
        ] : [])
        ->except(['default','default-styling','default-colors']) 
    }} x-data="{ opening: false, }" >

    <x-livewire-tables::table.tr id="{{ $dataTableFingerprint }}-row-{{ $rowPk }}" wire:key="{{ $dataTableFingerprint }}-tablerow-tr-{{ $rowPk }}" loopType="{{ ($rowIndex % 2 === 0) ? 'even' : 'odd' }}">


        @if($currentlyReorderingStatus)
            <x-livewire-tables::reorder.td x-cloak x-show="currentlyReorderingStatus" />
        @else
            @if($showBulkActionsSections)
                <x-livewire-tables::bulk-actions.td  />
            @endif
            @if ($showCollapsingColumnSections)
                <x-livewire-tables::collapsed-columns.td  />
            @endif
        @endif

        {{ $slot }}
        
    </x-livewire-tables::table.tr>

    @if ($showCollapsingColumnSections)
        <x-livewire-tables::collapsed-columns.tr />
    @endif
</tbody>