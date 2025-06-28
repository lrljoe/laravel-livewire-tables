@aware(['isTailwind','isTailwind4','isBootstrap', 'collapsingColumnInfo', 'tableRowDetails'])
@props(['colIndex', 'isHtml' => false, 'isClickable' => false, 'customAttributes' => ['default' => true]])

<td {{
        $attributes->merge($isClickable ? $tableRowDetails['tdAttribs'] : [])->merge($customAttributes)
            ->class([
                    'whitespace-wrap' => $isHtml && $isTailwind && ($customAttributes['default'] ?? true),
                    'whitespace-nowrap' => !$isHtml && $isTailwind && ($customAttributes['default'] ?? true),
                    'px-6 py-4  text-sm font-medium dark:text-white' => $isTailwind && ($customAttributes['default'] ?? true),
                    'cursor-pointer' => $isTailwind && ($isClickable && ($tableRowDetails['url'] !== null && ($tableRowDetails['attributes']['default'] ?? true))),
                    'tw4ph whitespace-wrap' => $isHtml && $isTailwind4 && ($customAttributes['default'] ?? true),
                    'tw4ph whitespace-nowrap' => !$isHtml && $isTailwind4 && ($customAttributes['default'] ?? true),
                    'tw4ph px-6 py-4 text-sm font-medium dark:text-white' => $isTailwind4 && ($customAttributes['default'] ?? true),
                    'tw4ph cursor-pointer' => $isTailwind4 && ($isClickable && ($tableRowDetails['url'] !== null && ($tableRowDetails['attributes']['default'] ?? true))),

                    '' => $isBootstrap && ($customAttributes['default'] ?? true),
                    'laravel-livewire-tables-cursor' => $isBootstrap && $isClickable,
            ])
            ->class($collapsingColumnInfo['collapsingColumnClasses'][$colIndex] ?? '')
            ->except(['default','default-styling','default-colors'])
    }}
>
    {{ $slot }}
</td>
