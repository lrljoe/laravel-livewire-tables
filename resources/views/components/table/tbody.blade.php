@aware(['tableName'])
@props(['row','rowIndex','rowPk'])
@php($coreTableAttributes = $this->getCoreTableAttributes())
@php($currentlyReorderingStatus = $this->getCurrentlyReorderingStatus())
@php($showBulkActionsSections = $this->showBulkActionsSections())
@php($showCollapsingColumnSections = $this->showCollapsingColumnSections())
@php($selectedVisibleColumns = $this->selectedVisibleColumns())


<tbody {{ $attributes->merge($coreTableAttributes['tbody'])
        ->class([
            'bg-white divide-gray-200 dark:bg-gray-800 dark:divide-none' => $coreTableAttributes['tbody']['default-colors'] ?? ($coreTableAttributes['tbody']['default'] ?? true),
            'divide-y' => $coreTableAttributes['tbody']['default-styling'] ?? ($coreTableAttributes['tbody']['default'] ?? true),
        ])
        ->except(['default','default-styling','default-colors']) 
    }} x-data
>
    <x-livewire-tables::table.tr wire:key="{{ $tableName }}-row-wrap-{{ $rowPk }}" :$row :$rowIndex :$rowPk>
                            
        @if($currentlyReorderingStatus)
            <x-livewire-tables::table.td.reorder x-cloak x-show="currentlyReorderingStatus" />
        @endif
        @if($showBulkActionsSections)
            <x-livewire-tables::table.td.bulk-actions  />
        @endif
        @if ($showCollapsingColumnSections)
            <x-livewire-tables::table.td.collapsed-columns  />
        @endif

        @tableloop($selectedVisibleColumns as $colIndex => $column)
            <x-livewire-tables::table.td wire:key="{{ $tableName . '-' . $rowPk . '-datatable-td-' . $column->getSlug() }}"  :$column :$colIndex >
                @if($column->isHtml())
                    {!! $column->setIndexes($rowIndex, $colIndex)->renderContents($row) !!}
                @else
                    {{ $column->setIndexes($rowIndex, $colIndex)->renderContents($row) }}
                @endif
            </x-livewire-tables::table.td>
        @endtableloop
    </x-livewire-tables::table.tr>

    @if ($showCollapsingColumnSections)
        <x-livewire-tables::table.collapsed-columns :$row :$rowIndex />
    @endif
</tbody>