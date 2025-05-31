@aware(['isTailwind', 'isTailwind4', 'isBootstrap', 'coreTableAttributes'])

<table {{ $attributes->merge($coreTableAttributes['table'])
        ->class([
            'rappasoft-livewire-table-new' => $isTailwind,
            'divide-gray-200 dark:divide-none' => $isTailwind && ($coreTableAttributes['table']['default-colors'] ?? ($coreTableAttributes['table']['default'] ?? true)),
            'min-w-full divide-y' => $isTailwind && ($coreTableAttributes['table']['default-styling'] ?? ($coreTableAttributes['table']['default'] ?? true)),
            
            'tw4ph rappasoft-livewire-table-new' => $isTailwind4,
            'tw4ph divide-gray-200 dark:divide-none' => $isTailwind4 && ($coreTableAttributes['table']['default-colors'] ?? ($coreTableAttributes['table']['default'] ?? true)),
            'tw4ph min-w-full divide-y' => $isTailwind4 && ($coreTableAttributes['table']['default-styling'] ?? ($coreTableAttributes['table']['default'] ?? true)),

            '' => $isBootstrap && ($coreTableAttributes['table']['default-colors'] ?? ($coreTableAttributes['table']['default'] ?? true)),
            'laravel-livewire-table table' => $isBootstrap && ($coreTableAttributes['table']['default-styling'] ?? ($coreTableAttributes['table']['default'] ?? true)),
        ])
        ->except(['default','default-styling','default-colors']) }}
>
    {{ $slot }}
</table>
        