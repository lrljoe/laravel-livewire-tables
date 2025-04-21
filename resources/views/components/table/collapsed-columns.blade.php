@aware([ 'tableName', 'primaryKey','isTailwind','isBootstrap', 'collapsingColumnDetails', 'row', 'rowIndex', 'rowPk', 'hasCollapsingColumns', 'hasTrAttributes'])

@if ($hasCollapsingColumns)
    @php($customAttributes = $hasTrAttributes ? $this->getTrAttributes($row, $rowIndex) : ['default' => true])
    <tr x-data
        @toggle-row-content.window="($event.detail.tableName === '{{ $tableName }}' && $event.detail.row === {{ $rowIndex }}) ? $el.classList.toggle('{{ $isBootstrap ? 'd-none' : 'hidden' }}') : null"
        {{
            $attributes->merge([
                    'wire:loading.class.delay' => 'opacity-50 dark:bg-gray-900 dark:opacity-60',
                    'wire:key' => $tableName.'-row-'.$rowPk.'-collapsed-contents',
                ])
                ->merge($customAttributes)
                ->class($isTailwind ? [
                    'hidden rappasoft-striped-row' => $customAttributes['default'] ?? true,
                ] : [
                    'd-none bg-light rappasoft-striped-row' => ($rowIndex % 2 === 0 && ($customAttributes['default'] ?? true)),
                    'd-none bg-white rappasoft-striped-row' => ($rowIndex % 2 !== 0 && ($customAttributes['default'] ?? true)),
                ])
                ->except(['default','default-styling','default-colors'])
        }}
    >
        <td colspan="{{ $this->getColspanCount() }}" @class([
                'text-left pt-4 pb-2 px-4' => $isTailwind,
                'text-start pt-3 p-2' => $isBootstrap,
        ])>
            <div >


                @tableloop($collapsingColumnDetails as $colIndex => $columnData)
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
