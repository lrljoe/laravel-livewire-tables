@aware([ 'row', 'rowIndex', 'rowPk', 'tableName', 'primaryKey','isTailwind','isBootstrap', 'collapsingColumnInfo', 'tableRowDetails'])
@props(['column', 'colIndex'])

@php
    $customAttributes = $this->getTdAttributes($column, $row, $colIndex, $rowIndex)
@endphp

<td wire:key="{{ $tableName . '-table-td-'.$rowPk.'-'.$column->getSlug() }}" x-ref="{{ $tableName . '_' . $rowIndex . '_' . $colIndex }}"
    @if ($column->isClickable())
        @if($tableRowDetails['target'] === 'navigate') wire:navigate href="{{ $tableRowDetails['url'] }}"
        @else onclick="window.open('{{ $tableRowDetails['url'] }}', '{{ $tableRowDetails['target'] }}')"
        @endif
    @endif
        {{
            $attributes->merge($customAttributes)
                ->class($isTailwind ? [
                        'px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $isTailwind && ($customAttributes['default'] ?? true),
                    ] : [
                        '' => ($customAttributes['default'] ?? true),
                        'laravel-livewire-tables-cursor' => $column && $column->isClickable(),
                    ])
                ->class($collapsingColumnInfo['collapsingColumnClasses'][$colIndex] ?? '')
                ->except(['default','default-styling','default-colors'])
        }}
    >
        {{ $slot }}
</td>
