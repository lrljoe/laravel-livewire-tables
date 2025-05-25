@aware(['tableName', 'isTailwind', 'isBootstrap', 'coreTableAttributes', 'currentlyReorderingStatus', 'showBulkActionsSections', 'showCollapsingColumnSections', 'selectedVisibleColumns', 'selectedVisibleColumns', 'hasDisplayLoadingPlaceholder', 'hasTdAttributes'])
@props(['row','rowIndex','rowPk', 'tableRowDetails'])

<tbody {{ $attributes->merge($coreTableAttributes['tbody'])
        ->merge($currentlyReorderingStatus ? [
            'x-sort:item' => "'".$rowPk."'",
            'data-id' => $rowPk,
        ] : [])
        ->merge($tableRowDetails['attributes'])
        ->class($isTailwind ? [
            'even:bg-white even:dark:bg-gray-700 odd:bg-gray-50 odd:dark:bg-gray-800 dark:text-white',
            'divide-gray-200 dark:divide-none' => $coreTableAttributes['tbody']['default-colors'] ?? ($coreTableAttributes['tbody']['default'] ?? true),
            'divide-y' => $coreTableAttributes['tbody']['default-styling'] ?? ($coreTableAttributes['tbody']['default'] ?? true),
        ] : [

        ])
        ->except(['default','default-styling','default-colors']) 
    }} x-data="{ opening: false, }" >

    <x-livewire-tables::table.tr id="{{ $tableName }}-row-{{ $rowPk }}" wire:key="{{ $tableName }}-tablerow-tr-{{ $rowPk }}" loopType="{{ ($rowIndex % 2 === 0) ? 'even' : 'odd' }}">


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
            <x-livewire-tables::table.td :isClickable="$column->isClickable()" :customAttributes="$hasTdAttributes ? $this->getTdAttributes($column, $row, $colIndex, $rowIndex) : ['default' => true]" :$colIndex wire:key="{{ $tableName . '-table-td-'.$rowPk.'-'.$column->getSlug() }}"  x-ref="{{ $tableName . '_' . $rowIndex . '_' . $colIndex }}">
                @if($column->setIndexes($rowIndex, $colIndex)->isHtml())
                    {!! $column->renderContents($row) !!}
                @else
                    {{ $column->renderContents($row) }}
                @endif
            </x-livewire-tables::table.td>
        @endtableloop
    </x-livewire-tables::table.tr>

    @if ($showCollapsingColumnSections)
        <x-livewire-tables::collapsed-columns.tr />
    @endif
</tbody>