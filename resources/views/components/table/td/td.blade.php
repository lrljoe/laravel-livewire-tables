@aware(['isTailwind','isTailwind4','isBootstrap', 'collapsingColumnInfo', 'tableRowDetails','defaultBodyTextAlign'])
@props(['columnTdArray' => ['textAlign' => $defaultBodyTextAlign, 'isClickable' => false, 'wrapText' => false, 'isHtml' => false], 'colIndex', 'isHtml' => $columnTdArray['isHtml'], 'wrapText' => $columnTdArray['wrapText'], 'isClickable' => $columnTdArray['isClickable'], 'customAttributes' => ['default' => true, 'default-colors' => true, 'default-styling' => true], 'textAlign' => $columnTdArray['textAlign']])

<td {{
        $attributes->merge($isClickable ? $tableRowDetails['tdAttribs'] : [])->merge($customAttributes)
            ->class($isTailwind ? [
                    'whitespace-wrap' => $wrapText,
                    'text-left' => $textAlign == 'left',
                    'text-center' => $textAlign == 'center',
                    'text-right' => $textAlign == 'right',
                    'whitespace-wrap' => (!$wrapText && $isHtml) && ($customAttributes['default-styling'] ?? true),
                    'whitespace-nowrap' => (!$wrapText && !$isHtml) && ($customAttributes['default-styling'] ?? true),
                    'px-6 py-4 text-sm font-medium' => ($customAttributes['default-styling'] ?? true),
                    'dark:text-white' => ($customAttributes['default-colors'] ?? true),
                    'cursor-pointer' => ($isClickable && ($tableRowDetails['url'] !== null && ($tableRowDetails['attributes']['default'] ?? true))),
            ] : [])
            ->class($isTailwind4 ? [                    
                    'whitespace-wrap' => (!$wrapText && $isHtml) && ($customAttributes['default-styling'] ?? true),
                    'whitespace-nowrap' => (!$wrapText && !$isHtml) && ($customAttributes['default-styling'] ?? true),
                    'text-left' =>  $textAlign == 'left',
                    'text-center' =>  $textAlign == 'center',
                    'text-right' => $textAlign == 'right',
                    'px-6 py-4 text-sm font-medium' => ($customAttributes['default-styling'] ?? true),
                    'dark:text-white' => ($customAttributes['default-colors'] ?? true),
                    'cursor-pointer' => ($isClickable && ($tableRowDetails['url'] !== null && ($tableRowDetails['attributes']['default'] ?? true))),
            ] : [])
            ->class($isBootstrap ? [                    
                    '' =>  ($customAttributes['default'] ?? true),
                    'laravel-livewire-tables-cursor' => $isClickable,
            ] : [])
            ->class($collapsingColumnInfo['collapsingColumnClasses'][$colIndex] ?? '')
            ->except(['default','default-colors','default-styling'])
    }}
>
    {{ $slot }}
</td>
