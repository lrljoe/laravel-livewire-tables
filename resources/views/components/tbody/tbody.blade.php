@aware(['dataTableFingerprint', 'isTailwind', 'isTailwind4', 'isBootstrap', 'coreTableAttributes', 'currentlyReorderingStatus', 'showBulkActionsSections', 'showCollapsingColumnSections', 'selectedVisibleColumns', 'selectedVisibleColumns', 'hasDisplayLoadingPlaceholder', 'hasTdAttributes', 'defaultBodyTextAlign', 'selectedVisibleColumnsData'])
@props(['row','rowIndex','rowPk', 'tableRowDetails'])

<tbody {{ $attributes->merge($coreTableAttributes['tbody'])
        ->merge($currentlyReorderingStatus ? [
            'x-sort:item' => "'".$rowPk."'",
            'data-id' => $rowPk,
        ] : [])
        ->merge($tableRowDetails['attributes'])
        ->class($isTailwind ? [
            'even:bg-white even:dark:bg-gray-700 odd:bg-gray-50 odd:dark:bg-gray-800 dark:text-white',
            'text-left' => $defaultBodyTextAlign == 'left',
            'text-center' => $defaultBodyTextAlign == 'center',
            'text-right' => $defaultBodyTextAlign == 'right',
            'divide-gray-200 dark:divide-none' => ($coreTableAttributes['tbody']['default-colors'] ?? ($coreTableAttributes['tbody']['default'] ?? true)),
            'divide-y' => ($coreTableAttributes['tbody']['default-styling'] ?? ($coreTableAttributes['tbody']['default'] ?? true)),          
        ] : [])
        ->class($isTailwind4 ? [           
            'tw4ph even:bg-white even:dark:bg-gray-700 odd:bg-gray-50 odd:dark:bg-gray-800 dark:text-white',
            'tw4ph divide-gray-200 dark:divide-none' => ($coreTableAttributes['tbody']['default-colors'] ?? ($coreTableAttributes['tbody']['default'] ?? true)),
            'tw4ph divide-y' => ($coreTableAttributes['tbody']['default-styling'] ?? ($coreTableAttributes['tbody']['default'] ?? true)),
            'tw4ph text-left' => $defaultBodyTextAlign == 'left',
            'tw4ph text-center' => $defaultBodyTextAlign == 'center',
            'tw4ph text-right' => $defaultBodyTextAlign == 'right',
            
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

        
        @tableloop($selectedVisibleColumns as $colIndex => $column)
            @php($columnTdArray = $selectedVisibleColumnsData[$column->setIndexes($rowIndex, $colIndex)->getHash()])
            <x-livewire-tables::table.td x-ref="{{ $dataTableFingerprint . '_' . $rowIndex . '_' . $colIndex }}"
                :$columnTdArray
                :customAttributes="$columnTdArray['hasTdAttributesCallback'] ? $this->getTdAttributes($column, $row, $colIndex, $rowIndex) : ['default' => true, 'default-colors' => true, 'default-styling' => true]" 
                :$colIndex  
                wire:key="{{ $dataTableFingerprint . '-table-td-'.$rowPk.'-'.$columnTdArray['slug'] }}"  
                
             >
                @if($columnTdArray['isHtml'])
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