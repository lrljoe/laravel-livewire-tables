@aware(['isTailwind','isTailwind4','isBootstrap'])
@props(['customAttributes' => [], 'displayMinimisedOnReorder' => true, 'rowIndex' => "-1" ])

<tr {{ $attributes
        ->merge($customAttributes)
        ->class([
            // Tailwind 3
            'unsortable' => $isTailwind,
            'laravel-livewire-tables-reorderingMinimised' => $isTailwind,
            'bg-white dark:bg-gray-700 dark:text-white' => $isTailwind && ($customAttributes['default'] ?? true),
            
            // Tailwind 4
            'unsortable' => $isTailwind4,
            'laravel-livewire-tables-reorderingMinimised' => $isTailwind4,
            'bg-white dark:bg-gray-700 dark:text-white' => $isTailwind4 && ($customAttributes['default'] ?? true),

            // Bootstrap
            'laravel-livewire-tables-reorderingMinimised' => $isBootstrap,
            '' => $isBootstrap && ($customAttributes['default'] ?? true),

        ])
        ->except(['default','default-styling','default-colors'])
    }}
>
    {{ $slot }}
</tr>
