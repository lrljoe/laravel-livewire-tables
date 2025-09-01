@aware(['isTailwind','isTailwind4','isBootstrap', 'collapsingColumnInfo', 'tableRowDetails','defaultBodyTextAlign'])
@props(['colIndex', 'isHtml' => false, 'wrapText' => false, 'isClickable' => false, 'customAttributes' => ['default' => true, 'default-colors' => true, 'default-styling' => true], 'textAlign' => $defaultBodyTextAlign, 'columnObscureContentAttributes' => new \Illuminate\View\ComponentAttributeBag(['x-data' => "{ obscure: false }"])])

<td {{
        $attributes->merge($isClickable ? $tableRowDetails['tdAttribs'] : [])->merge($customAttributes)
            ->class([
                'whitespace-wrap' => $wrapText && $isTailwind,
            ])
            ->class([
                    'text-left' => $textAlign == 'left' && $isTailwind,
                    'text-center' => $textAlign == 'center' && $isTailwind,
                    'text-right' => $textAlign == 'right' && $isTailwind,

                    'whitespace-wrap' => (!$wrapText && $isHtml) && $isTailwind && ($customAttributes['default-styling'] ?? true),
                    'whitespace-nowrap' => (!$wrapText && !$isHtml) && $isTailwind && ($customAttributes['default-styling'] ?? true),

                    'px-6 py-4 text-sm font-medium' => $isTailwind && ($customAttributes['default-styling'] ?? true),
                    'dark:text-white' => $isTailwind && ($customAttributes['default-colors'] ?? true),

                    'cursor-pointer' => $isTailwind && ($isClickable && ($tableRowDetails['url'] !== null && ($tableRowDetails['attributes']['default'] ?? true))),
                    
                    'tw4ph whitespace-wrap' => (!$wrapText && $isHtml) && $isTailwind4 && ($customAttributes['default-styling'] ?? true),
                    'tw4ph whitespace-nowrap' => (!$wrapText && !$isHtml) && $isTailwind4 && ($customAttributes['default-styling'] ?? true),

                    'tw4ph text-left' => $textAlign == 'left' && $isTailwind4,
                    'tw4ph text-center' => $textAlign == 'center' && $isTailwind4,
                    'tw4ph text-right' => $textAlign == 'right' && $isTailwind4,


                    'tw4ph px-6 py-4 text-sm font-medium' => $isTailwind4 && ($customAttributes['default-styling'] ?? true),
                    'tw4ph dark:text-white' => $isTailwind4 && ($customAttributes['default-colors'] ?? true),

                    'tw4ph cursor-pointer' => $isTailwind4 && ($isClickable && ($tableRowDetails['url'] !== null && ($tableRowDetails['attributes']['default'] ?? true))),

                    '' => $isBootstrap && ($customAttributes['default'] ?? true),
                    'laravel-livewire-tables-cursor' => $isBootstrap && $isClickable,
            ])
            ->class($collapsingColumnInfo['collapsingColumnClasses'][$colIndex] ?? '')
            ->except(['default','default-colors','default-styling'])
    }}
>
    <div {{ $columnObscureContentAttributes }}>
        <div x-cloak x-show="obscure">
            *********
        </div>
        <div x-cloak x-show="!obscure">
            {{ $slot }}
        </div>
    </div>
</td>
