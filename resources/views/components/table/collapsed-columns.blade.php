@aware([ 'tableName', 'primaryKey','isTailwind','isBootstrap', 'collapsingColumnDetails'])
@props(['row', 'rowIndex'])

@if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
    @php($customAttributes = $this->getTrAttributes($row, $rowIndex))
    <tr x-data
        @toggle-row-content.window="($event.detail.tableName === '{{ $tableName }}' && $event.detail.row === {{ $rowIndex }}) ? $el.classList.toggle('{{ $isBootstrap ? 'd-none' : 'hidden' }}') : null"
        {{
            $attributes->merge([
                    'wire:loading.class.delay' => 'opacity-50 dark:bg-gray-900 dark:opacity-60',
                    'wire:key' => $tableName.'-row-'.$row->{$primaryKey}.'-collapsed-contents',
                ])
                ->merge($customAttributes)
                ->class($isTailwind ? [
                    'hidden bg-white dark:bg-gray-700 dark:text-white rappasoft-striped-row' => (($customAttributes['default'] ?? true) && $rowIndex % 2 === 0),
                    'hidden bg-gray-50 dark:bg-gray-800 dark:text-white rappasoft-striped-row' => (($customAttributes['default'] ?? true) && $rowIndex % 2 !== 0),
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
            <div>


                @tableloop($collapsingColumnDetails as $colIndex => $columnData)
                    <div wire:key="{{ $tableName }}-row-{{ $row->{$primaryKey} }}-collapsed-contents-{{ $colIndex }}" 
                        x-data="{ value: '', 
                            init() { 
                                $nextTick(() => { 
                                    this.value = stripLivewireTags($refs.{{ $tableName . '_' . $rowIndex.'_'.$colIndex }});
                                });
                            }
                            }" @class($isTailwind ? [
                                'block mb-2 hidden',
                                'sm:block' => $columnData['shouldCollapseAlways'],
                                'sm:block md:hidden' => !$columnData['shouldCollapseAlways'] && !$columnData['shouldCollapseOnTablet'] && $columnData['shouldCollapseOnMobile'],
                                'sm:block lg:hidden' => !$columnData['shouldCollapseAlways'] && ($columnData['shouldCollapseOnTablet'] || $columnData['shouldCollapseOnMobile']),
                        ] : [
                                'd-block mb-2',
                                'd-sm-none' => !$columnData['shouldCollapseAlways'] && !$columnData['shouldCollapseOnTablet'] && !$columnData['shouldCollapseOnMobile'],
                                'd-md-none' => !$columnData['shouldCollapseAlways'] && !$columnData['shouldCollapseOnTablet'] && $columnData['shouldCollapseOnMobile'],
                                'd-lg-none' => !$columnData['houldCollapseAlway'] && ($columnData['shouldCollapseOnTablet'] || $columnData['shouldCollapseOnMobile']),

                        ])>
                                <strong>{{ $columnData['title'] }}</strong>: <br />
                                <span @if($columnData['isHtml'])x-html="value" @else x-text="value"@endif></span>
                    </div>
                @endtableloop
            </div>
        </td>
    </tr>
@endif
