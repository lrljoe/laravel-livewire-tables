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
        @endif
        @if(!$currentlyReorderingStatus && $showBulkActionsSections)
            <x-livewire-tables::bulk-actions.td  />
        @endif
        @if (!$currentlyReorderingStatus && $showCollapsingColumnSections)
            <x-livewire-tables::collapsed-columns.td  />
        @endif
        
        @tableloop($selectedVisibleColumns as $colIndex => $column)
            @php
                $columnTdArray = $selectedVisibleColumnsData[$column->setIndexes($rowIndex, $colIndex)->getHash()];
                $customAttributes = $columnTdArray['hasTdAttributesCallback'] ? $this->getTdAttributes($column, $row, $colIndex, $rowIndex) : ['default' => true, 'default-colors' => true, 'default-styling' => true];
                if(!isset($selectedVisibleColumnsData[$column->getHash()]['extraData']))
                {
                    if(!$columnTdArray['hasTdAttributesCallback'])
                    {
                        $selectedVisibleColumnsData[$column->getHash()]['extraData'] = $attributes->merge($columnTdArray['isClickable'] ? $tableRowDetails['tdAttribs'] : [])->merge($customAttributes)
                        ->class($isTailwind ? [
                                'whitespace-wrap' => $columnTdArray['wrapText'],
                                'text-left' => $columnTdArray['textAlign'] == 'left',
                                'text-center' => $columnTdArray['textAlign'] == 'center',
                                'text-right' => $columnTdArray['textAlign'] == 'right',
                                'cursor-pointer' => ($columnTdArray['isClickable'] && ($tableRowDetails['url'] !== null && ($tableRowDetails['attributes']['default'] ?? true))),
                                'whitespace-wrap' => (!$columnTdArray['wrapText'] && $columnTdArray['isHtml']) && ($customAttributes['default-styling'] ?? true),
                                'whitespace-nowrap' => (!$columnTdArray['wrapText'] && !$columnTdArray['isHtml']) && ($customAttributes['default-styling'] ?? true),
                                'px-6 py-4 text-sm font-medium' => ($customAttributes['default-styling'] ?? true),
                                'dark:text-white' => ($customAttributes['default-colors'] ?? true),
                        ] : [])
                        ->class($collapsingColumnInfo['collapsingColumnClasses'][$colIndex] ?? '')
                        ->except(['default','default-colors','default-styling']);
                    }
                    else
                    {
                        $selectedVisibleColumnsData[$column->getHash()]['extraData'] = $attributes->merge($columnTdArray['isClickable'] ? $tableRowDetails['tdAttribs'] : [])->merge($customAttributes)
                        ->class($isTailwind ? [
                                'whitespace-wrap' => $columnTdArray['wrapText'],
                                'text-left' => $columnTdArray['textAlign'] == 'left',
                                'text-center' => $columnTdArray['textAlign'] == 'center',
                                'text-right' => $columnTdArray['textAlign'] == 'right',
                                'cursor-pointer' => ($columnTdArray['isClickable'] && ($tableRowDetails['url'] !== null && ($tableRowDetails['attributes']['default'] ?? true))),
                        ] : [])
                        ->class($collapsingColumnInfo['collapsingColumnClasses'][$colIndex] ?? '')
                        ->except(['default','default-colors','default-styling']);

                    }
                    
                }
                $extraData = $selectedVisibleColumnsData[$column->getHash()]['extraData'];
                

            @endphp
            <td {{
                    $extraData->class(($isTailwind && $columnTdArray['hasTdAttributesCallback']) ? [
                                'whitespace-wrap' => (!$columnTdArray['wrapText'] && $columnTdArray['isHtml']) && ($customAttributes['default-styling'] ?? true),
                                'whitespace-nowrap' => (!$columnTdArray['wrapText'] && !$columnTdArray['isHtml']) && ($customAttributes['default-styling'] ?? true),
                                'px-6 py-4 text-sm font-medium' => ($customAttributes['default-styling'] ?? true),
                                'dark:text-white' => ($customAttributes['default-colors'] ?? true),
                            ] : [])
                }}
            >
                <div {{ $columnTdArray['columnObscureContentAttributes'] }}>
                    <div x-cloak x-show="obscure">
                        *********
                    </div>
                    <div x-cloak x-show="!obscure">
                        @if($columnTdArray['isHtml'])
                            {!! $column->renderContents($row) !!}
                        @else
                            {{ $column->renderContents($row) }}
                        @endif
                    </div>
                </div>
            </td>

        @endtableloop
    </x-livewire-tables::table.tr>

    @if ($showCollapsingColumnSections)
        <x-livewire-tables::collapsed-columns.tr />
    @endif
</tbody>