@aware(['isTailwind', 'isTailwind4', 'isBootstrap', 'coreTableAttributes'])

<div {{ $attributes->merge($coreTableAttributes['wrapper'])
        ->class([
            'border-gray-200 dark:border-gray-700' => $isTailwind && ($coreTableAttributes['wrapper']['default-colors'] ?? ($coreTableAttributes['wrapper']['default'] ?? true)),
            'shadow overflow-y-auto border-b sm:rounded-lg' => $isTailwind && ($coreTableAttributes['wrapper']['default-styling'] ?? ($coreTableAttributes['wrapper']['default'] ?? false)),
            'tw4ph border-gray-200 dark:border-gray-700' => $isTailwind4 && ($coreTableAttributes['wrapper']['default-colors'] ?? ($coreTableAttributes['wrapper']['default'] ?? true)),
            'tw4ph shadow overflow-y-auto border-b sm:rounded-lg' => $isTailwind4 && ($coreTableAttributes['wrapper']['default-styling'] ?? ($coreTableAttributes['wrapper']['default'] ?? false)),
            '' => $isBootstrap && ($coreTableAttributes['wrapper']['default-colors'] ?? ($coreTableAttributes['wrapper']['default'] ?? true)),
            'table-responsive' => $isBootstrap && ($coreTableAttributes['wrapper']['default-styling'] ?? ($coreTableAttributes['wrapper']['default'] ?? true)),
        ])
        ->except(['default','default-styling','default-colors'])
}}>
    {{ $slot }}
</div>