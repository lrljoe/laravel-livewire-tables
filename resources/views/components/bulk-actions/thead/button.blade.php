@aware(['isTailwind','isTailwind4','isBootstrap','isBootstrap4','isBootstrap5','bulkActionsRowButtonAttributes'])
@props(['bulkActionsRowButtonAttributes'])
<button {{ 
        $attributes->merge([
            'wire:loading.attr' => 'disabled',
            'type' => 'button',
        ])
        ->merge($bulkActionsRowButtonAttributes)
        ->class($isTailwind ? [
                'ml-1 underline text-sm leading-5 font-medium focus:outline-none focus:underline transition duration-150 ease-in-out' => ($bulkActionsRowButtonAttributes['default-styling'] ?? true),
                'text-blue-600 text-gray-700 focus:text-gray-800 dark:text-white dark:hover:text-gray-400' => ($bulkActionsRowButtonAttributes['default-colors'] ?? true),
        ]: [])
        ->class($isTailwind4 ? [
                'ml-1 underline text-sm leading-5 font-medium focus:outline-none focus:underline transition duration-150 ease-in-out' => ($bulkActionsRowButtonAttributes['default-styling'] ?? true),
                'text-blue-600 text-gray-700 focus:text-gray-800 dark:text-white dark:hover:text-gray-400' => ($bulkActionsRowButtonAttributes['default-colors'] ?? true),
        ]: [])
        ->class($isBootstrap4 ? [
            'btn btn-primary btn-sm' => ($bulkActionsRowButtonAttributes['default-styling'] ?? true),
        ]: [])
        ->class($isBootstrap5 ? [
            'btn btn-primary btn-sm' => ($bulkActionsRowButtonAttributes['default-styling'] ?? true),
        ]: [])
        ->except(['default','default-colors','default-styling'])

    }}
>
    {{ $slot }}
</button>
