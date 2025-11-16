@aware(['isTailwind','isTailwind4','isBootstrap'])
@props(['customAttributes' => [], 'displayMinimisedOnReorder' => true, 'rowIndex' => "-1" ])

<tr {{ $attributes
        ->merge($customAttributes)
        ->class($isTailwind ? [
            'unsortable laravel-livewire-tables-reorderingMinimised',
            'bg-white dark:bg-gray-700 dark:text-white' => ($customAttributes['default'] ?? true),
        ] : [])
        ->class($isTailwind4 ? [
            'unsortable laravel-livewire-tables-reorderingMinimised',
            'bg-white dark:bg-gray-700 dark:text-white' => ($customAttributes['default'] ?? true),
        ] : [])
        ->class($isBootstrap ? [
            'laravel-livewire-tables-reorderingMinimised',
        ] : [])
        ->except(['default','default-styling','default-colors'])
    }}
>
    {{ $slot }}
</tr>
