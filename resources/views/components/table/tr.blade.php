@aware(['isTailwind', 'isTailwind4', 'isBootstrap', 'rowIndex', 'hasDisplayLoadingPlaceholder', 'tableRowDetails'])

<tr 
    @if($hasDisplayLoadingPlaceholder) 
        wire:loading.class.add="hidden d-none"
    @else
        wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
    @endif
    {{
        $attributes->merge($tableRowDetails['attributes'])
            ->class([
                // Tailwind 3
                'rappasoft-striped-row' => $isTailwind && ($tableRowDetails['attributes']['default'] ?? true),

                // Tailwind 4
                'rappasoft-striped-row' => $isTailwind4 && ($tableRowDetails['attributes']['default'] ?? true),

                // Bootstrap
                'bg-light rappasoft-striped-row' => $isBootstrap && ($rowIndex % 2 === 0 && ($tableRowDetails['attributes']['default'] ?? true)),
                'bg-white rappasoft-striped-row' => $isBootstrap && ($rowIndex % 2 !== 0 && ($tableRowDetails['attributes']['default'] ?? true)),
            ])
            ->except(['default','default-styling','default-colors'])
    }}
>
    {{ $slot }}
</tr>
