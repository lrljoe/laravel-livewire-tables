@aware(['isTailwind','isBootstrap', 'collapsingColumnInfo', 'tableRowDetails'])
@props(['colIndex', 'isClickable' => false, 'customAttributes' => ['default' => true]])


<td
        {{
            $attributes->merge($isClickable ? $tableRowDetails['tdAttribs'] : [])->merge($customAttributes)
                ->class($isTailwind ? [
                        'px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => ($customAttributes['default'] ?? true),
                        'cursor-pointer' => $isClickable && ($tableRowDetails['url'] !== null && ($tableRowDetails['attributes']['default'] ?? true)),
                    ] : [
                        '' => ($customAttributes['default'] ?? true),
                        'laravel-livewire-tables-cursor' => $isClickable,
                    ])
                ->class($collapsingColumnInfo['collapsingColumnClasses'][$colIndex] ?? '')
                ->except(['default','default-styling','default-colors'])
        }}
    >
        {{ $slot }}
</td>
