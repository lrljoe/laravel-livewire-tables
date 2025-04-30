@aware([ 'tableName','isTailwind', 'rowPk', 'rowIndex', 'hasDisplayLoadingPlaceholder', 'tableRowDetails'])

<tr
    rowpk='{{ $rowPk }}'
    @if($hasDisplayLoadingPlaceholder) 
        wire:loading.class.add="hidden d-none"
    @else
        wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
    @endif
    id="{{ $tableName }}-row-{{ $rowPk }}"
    wire:key="{{ $tableName }}-tablerow-tr-{{ $rowPk }}"
    loopType="{{ ($rowIndex % 2 === 0) ? 'even' : 'odd' }}"
    {{
        $attributes->merge($tableRowDetails['attributes'])
                ->class($isTailwind ? [
                    'rappasoft-striped-row' => $tableRowDetails['attributes']['default'] ?? true,
                    'cursor-pointer' => ($tableRowDetails['url'] !== null && ($tableRowDetails['attributes']['default'] ?? true)),
                ] : 
                [
                    'bg-light rappasoft-striped-row' => ($rowIndex % 2 === 0 && ($tableRowDetails['attributes']['default'] ?? true)),
                    'bg-white rappasoft-striped-row' => ($rowIndex % 2 !== 0 && ($tableRowDetails['attributes']['default'] ?? true)),

                ])
                ->except(['default','default-styling','default-colors'])
    }}

>
    {{ $slot }}
</tr>
