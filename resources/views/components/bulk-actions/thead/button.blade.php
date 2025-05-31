@aware(['isTailwind','isTailwind4','isBootstrap','bulkActionsRowButtonAttributes'])
@props(['bulkActionsRowButtonAttributes'])
<button {{ 
        $attributes->merge([
            'wire:loading.attr' => 'disabled',
            'type' => 'button',
        ])
        ->merge($bulkActionsRowButtonAttributes)
        ->class(
            [
                'ml-1 underline text-sm leading-5 font-medium focus:outline-none focus:underline transition duration-150 ease-in-out' => $isTailwind && ($bulkActionsRowButtonAttributes['default-styling'] ?? true),
                'text-blue-600 text-gray-700 focus:text-gray-800 dark:text-white dark:hover:text-gray-400' => $isTailwind && ($bulkActionsRowButtonAttributes['default-colors'] ?? true),
                'tw4ph ml-1 underline text-sm leading-5 font-medium focus:outline-none focus:underline transition duration-150 ease-in-out' => $isTailwind4 && ($bulkActionsRowButtonAttributes['default-styling'] ?? true),
                'tw4ph text-blue-600 text-gray-700 focus:text-gray-800 dark:text-white dark:hover:text-gray-400' => $isTailwind4 && ($bulkActionsRowButtonAttributes['default-colors'] ?? true),
                'btn btn-primary btn-sm' => $isBootstrap && ($bulkActionsRowButtonAttributes['default-styling'] ?? true)
            ]
        )
        ->except(['default','default-colors','default-styling'])
    }}
>
    {{ $slot }}
</button>