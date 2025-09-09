@aware(['isTailwind', 'isTailwind4', 'isBootstrap', 'coreTableAttributes'])

<div {{ $attributes->merge($coreTableAttributes['wrapper'])
        ->class($isTailwind ? [
            'border-gray-200 dark:border-gray-700' => ($coreTableAttributes['wrapper']['default-colors'] ?? ($coreTableAttributes['wrapper']['default'] ?? true)),
            'shadow overflow-y-auto border-b sm:rounded-lg' => ($coreTableAttributes['wrapper']['default-styling'] ?? ($coreTableAttributes['wrapper']['default'] ?? false)),
        ] : [])
        ->class($isTailwind4 ? [
            'tw4ph border-gray-200 dark:border-gray-700' => ($coreTableAttributes['wrapper']['default-colors'] ?? ($coreTableAttributes['wrapper']['default'] ?? true)),
            'tw4ph shadow overflow-y-auto border-b sm:rounded-lg' => ($coreTableAttributes['wrapper']['default-styling'] ?? ($coreTableAttributes['wrapper']['default'] ?? false)),
        ] : [])
        ->class($isBootstrap ? [
            '' => ($coreTableAttributes['wrapper']['default-colors'] ?? ($coreTableAttributes['wrapper']['default'] ?? true)),
            'table-responsive' => ($coreTableAttributes['wrapper']['default-styling'] ?? ($coreTableAttributes['wrapper']['default'] ?? true)),
        ] : [])
        ->except(['default','default-styling','default-colors'])
}}>
    {{ $slot }}
</div>