@aware(['tableName', 'isTailwind', 'isBootstrap', 'coreTableAttributes', 'currentlyReorderingStatus', 'showBulkActionsSections', 'showCollapsingColumnSections', 'selectedVisibleColumns', 'selectedVisibleColumns'])
@props(['row','rowIndex','rowPk', 'tableRowDetails'])

<tbody {{ $attributes->merge($coreTableAttributes['tbody'])
        ->merge($currentlyReorderingStatus ? [
            'x-sort:item' => $rowPk,
            'data-id' => $rowPk,
        ] : [])
        ->merge($tableRowDetails['attributes'])
        ->class($isTailwind ? [
            'odd:bg-white odd:dark:bg-gray-700 even:bg-gray-50 even:dark:bg-gray-800 dark:text-white',
            'divide-gray-200 dark:divide-none' => $coreTableAttributes['tbody']['default-colors'] ?? ($coreTableAttributes['tbody']['default'] ?? true),
            'divide-y' => $coreTableAttributes['tbody']['default-styling'] ?? ($coreTableAttributes['tbody']['default'] ?? true),
        ] : [

        ])
        ->except(['default','default-styling','default-colors']) 
    }} x-data="{ opening: false, }" >

    <x-livewire-tables::table.tr wire:key="{{ $tableName }}-row-wrap-{{ $rowPk }}"  >
                            
        @if($currentlyReorderingStatus)
            <x-livewire-tables::reorder.td x-cloak x-show="currentlyReorderingStatus" />
        @endif
        @if(!$currentlyReorderingStatus && $showBulkActionsSections)
            <x-livewire-tables::bulk-actions.td  />
        @endif
        @if (!$currentlyReorderingStatus && $showCollapsingColumnSections)
            <x-livewire-tables::collapsed-columns.td  />

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
        <x-livewire-tables::collapsed-columns.tr />
    @endif
</tbody>