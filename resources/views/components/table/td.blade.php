@aware([ 'row', 'rowIndex', 'tableName', 'primaryKey','isTailwind','isBootstrap', 'collapsingColumnClasses'])
@props(['column', 'colIndex'])

@php
    $customAttributes = $this->getTdAttributes($column, $row, $colIndex, $rowIndex)
@endphp

<td wire:key="{{ $tableName . '-table-td-'.$row->{$primaryKey}.'-'.$column->getSlug() }}" x-ref="{{ $tableName . "_" . $rowIndex."_".$colIndex}}"
    @if ($column->isClickable())
        @if($this->getTableRowUrlTarget($row) === 'navigate') wire:navigate href="{{ $this->getTableRowUrl($row) }}"
        @else onclick="window.open('{{ $this->getTableRowUrl($row) }}', '{{ $this->getTableRowUrlTarget($row) ?? '_self' }}')"
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
                ->class($collapsingColumnClasses[$colIndex] ?? '')
                ->except(['default','default-styling','default-colors'])
        }}
    >
        {{ $slot }}
</td>
