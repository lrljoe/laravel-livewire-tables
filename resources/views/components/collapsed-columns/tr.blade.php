@aware([ 'dataTableFingerprint', 'isTailwind','isTailwind4','isBootstrap', 'collapsingColumnInfo', 'row', 'rowIndex', 'rowPk', 'tableRowDetails'])

@if ($collapsingColumnInfo['hasCollapsingColumns'])
    <tr x-data
        @toggle-row-content.window="($event.detail.dataTableFingerprint === '{{ $dataTableFingerprint }}' && $event.detail.row === {{ $rowIndex }}) ? $el.classList.toggle('{{ $isBootstrap ? 'd-none' : 'hidden' }}') : null"
        {{
            $attributes->merge([
                    'wire:loading.class.delay' => 'opacity-50 dark:bg-gray-900 dark:opacity-60',
                    'wire:key' => $dataTableFingerprint.'-row-'.$rowPk.'-collapsed-contents',
                ])
                ->merge($tableRowDetails['attributes'])
                ->class($isTailwind ? [
                    'hidden rappasoft-striped-row' => ($tableRowDetails['attributes']['default'] ?? true),
                ] : [])
                ->class($isTailwind4 ? [
                    'tw4ph hidden rappasoft-striped-row' => ($tableRowDetails['attributes']['default'] ?? true),
                ] : [])
                ->class($isBootstrap ? [
                    'd-none bg-light rappasoft-striped-row' => ($rowIndex % 2 === 0 && ($tableRowDetails['attributes']['default'] ?? true)),
                    'd-none bg-white rappasoft-striped-row' => ($rowIndex % 2 !== 0 && ($tableRowDetails['attributes']['default'] ?? true)),
                ] : [])
                ->except(['default','default-styling','default-colors'])
        }}
    >
        <td colspan="{{ $collapsingColumnInfo['colspanCount'] }}" 
            @class([
                'text-left pt-4 pb-2 px-4' => $isTailwind,
                'tw4ph text-left pt-4 pb-2 px-4' => $isTailwind4,
                'text-start pt-3 p-2' => $isBootstrap, 
            ])
        >
            <div>
                @tableloop($collapsingColumnInfo['collapsingColumnDetails'] as $colIndex => $columnData)
                    @php($key = $dataTableFingerprint . '_' . $rowIndex.'_'.$colIndex)
                    <div wire:key="{{ $dataTableFingerprint }}-row-{{ $rowPk }}-collapsed-contents-{{ $colIndex }}" @class($columnData['classes'])
                        x-data="{ value: '', 
                                init() { 
                                    $watch('opening', val => {
                                        this.value = stripLivewireTags($refs.{{ $dataTableFingerprint . '_' . $rowIndex.'_'.$colIndex }});
                                    });
                                }
                            }" 
                            
                    >
                        <strong>{{ $columnData['title'] }}</strong>: <br />
                        <span @if($columnData['isHtml'])x-html="value" @else x-text="value"@endif> </span>
                    </div>
                @endtableloop
            </div>
        </td>
    </tr>
@endif
