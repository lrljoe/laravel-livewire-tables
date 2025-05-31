@aware(['isTailwind','isTailwind4','isBootstrap', 'collapsingColumnInfo', 'tableRowDetails'])
@props(['colIndex', 'isClickable' => false, 'customAttributes' => ['default' => true]])

<td {{
        $attributes->merge($isClickable ? $tableRowDetails['tdAttribs'] : [])->merge($customAttributes)
            ->class([
                    // Tailwind 3
                    'px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $isTailwind && ($customAttributes['default'] ?? true),
                    'cursor-pointer' => $isTailwind && ($isClickable && ($tableRowDetails['url'] !== null && ($tableRowDetails['attributes']['default'] ?? true))),

                    // Tailwind 4
                    'px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $isTailwind4 && ($customAttributes['default'] ?? true),
                    'cursor-pointer' => $isTailwind4 && ($isClickable && ($tableRowDetails['url'] !== null && ($tableRowDetails['attributes']['default'] ?? true))),

                    // Bootstrap
                    '' => $isBootstrap && ($customAttributes['default'] ?? true),
                    'laravel-livewire-tables-cursor' => $isBootstrap && $isClickable,
                ])
            ->class($collapsingColumnInfo['collapsingColumnClasses'][$colIndex] ?? '')
            ->except(['default','default-styling','default-colors'])
    }}
>
    {{ $slot }}
</td>
