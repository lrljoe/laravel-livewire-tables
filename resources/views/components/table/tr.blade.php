@aware([ 'tableName','primaryKey','isTailwind','isBootstrap', 'rowPk', 'row', 'rowIndex', 'hasDisplayLoadingPlaceholder', 'hasTrAttributes'])
@php
    $customAttributes = $hasTrAttributes ? $this->getTrAttributes($row, $rowIndex) : ['default' => true];
@endphp


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
        $attributes->merge($customAttributes)
                ->class($isTailwind ? [
                    'rappasoft-striped-row' => $customAttributes['default'] ?? true,
                    'cursor-pointer' => ($this->hasTableRowUrl() && ($customAttributes['default'] ?? true)),
                ] : 
                [
                    'bg-light rappasoft-striped-row' => ($rowIndex % 2 === 0 && ($customAttributes['default'] ?? true)),
                    'bg-white rappasoft-striped-row' => ($rowIndex % 2 !== 0 && ($customAttributes['default'] ?? true)),

                ])
                ->except(['default','default-styling','default-colors'])
    }}

>
    {{ $slot }}
</tr>
