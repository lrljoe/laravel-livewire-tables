@aware([ 'tableName', 'isTailwind','isBootstrap', 'collapsingColumnInfo', 'row', 'rowIndex', 'rowPk', 'tableRowDetails'])

@if ($collapsingColumnInfo['hasCollapsingColumns'] ?? false)
    <tr x-data
        @toggle-row-content.window="($event.detail.tableName === '{{ $tableName }}' && $event.detail.row === {{ $rowIndex }}) ? $el.classList.toggle('{{ $isBootstrap ? 'd-none' : 'hidden' }}') : null"
        {{
            $attributes->merge([
                    'wire:loading.class.delay' => 'opacity-50 dark:bg-gray-900 dark:opacity-60',
                    'wire:key' => $tableName.'-row-'.$rowPk.'-collapsed-contents',
                ])
                ->merge($tableRowDetails['attributes'])
                ->class($isTailwind ? [
                    'hidden rappasoft-striped-row' => $tableRowDetails['attributes']['default'] ?? true,
                ] : [
                    'd-none bg-light rappasoft-striped-row' => ($rowIndex % 2 === 0 && ($tableRowDetails['attributes']['default'] ?? true)),
                    'd-none bg-white rappasoft-striped-row' => ($rowIndex % 2 !== 0 && ($tableRowDetails['attributes']['default'] ?? true)),
                ])
                ->except(['default','default-styling','default-colors'])
        }}
    >
        <td colspan="{{ $collapsingColumnInfo['colspanCount'] }}" @class([
                'text-left pt-4 pb-2 px-4' => $isTailwind,
                'text-start pt-3 p-2' => $isBootstrap,
        ])>
            <div >


                @tableloop($collapsingColumnInfo['collapsingColumnDetails'] as $colIndex => $columnData)
                @php($key = $tableName . '_' . $rowIndex.'_'.$colIndex)
                    <div wire:key="{{ $tableName }}-row-{{ $rowPk }}-collapsed-contents-{{ $colIndex }}" 
                        x-data="{ value: '', 
                                init() { 
                                    $watch('opening', val => {
                                        this.value = stripLivewireTags($refs.{{ $tableName . '_' . $rowIndex.'_'.$colIndex }});
                                    });
                                }
                            }" @class($columnData['classes'])>
                                <strong>{{ $columnData['title'] }}</strong>: <br />
                                <span @if($columnData['isHtml'])x-html="value" @else x-text="value"@endif></span>
                    </div>
                @endtableloop
            </div>
        </td>
    </tr>
@endif
