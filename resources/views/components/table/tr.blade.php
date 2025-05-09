@aware(['isTailwind', 'rowIndex', 'hasDisplayLoadingPlaceholder', 'tableRowDetails'])

<tr 
    @if($hasDisplayLoadingPlaceholder) 
        wire:loading.class.add="hidden d-none"
    @else
        wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
    @endif
    {{
        $attributes->merge($tableRowDetails['attributes'])
                ->class($isTailwind ? [
                    'rappasoft-striped-row' => $tableRowDetails['attributes']['default'] ?? true,
                ] : 
                [
                    'bg-light rappasoft-striped-row' => ($rowIndex % 2 === 0 && ($tableRowDetails['attributes']['default'] ?? true)),
                    'bg-white rappasoft-striped-row' => ($rowIndex % 2 !== 0 && ($tableRowDetails['attributes']['default'] ?? true)),

                ])
                ->except(['default','default-styling','default-colors'])
    }}

>
    {{ $slot }}
</tr>
