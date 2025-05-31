@aware(['isTailwind','isTailwind4','isBootstrap'])
@props(['customAttributes' => [], 'displayMinimisedOnReorder' => true, 'rowIndex' => "-1" ])

<tr {{ $attributes
        ->merge($customAttributes)
        ->class([
            'unsortable' => $isTailwind,
            'laravel-livewire-tables-reorderingMinimised' => $isTailwind,
            'bg-white dark:bg-gray-700 dark:text-white' => $isTailwind && ($customAttributes['default'] ?? true),
            'tw4ph unsortable' => $isTailwind4,
            'tw4ph laravel-livewire-tables-reorderingMinimised' => $isTailwind4,
            'tw4ph bg-white dark:bg-gray-700 dark:text-white' => $isTailwind4 && ($customAttributes['default'] ?? true),
            
            'laravel-livewire-tables-reorderingMinimised' => $isBootstrap,
            '' => $isBootstrap && ($customAttributes['default'] ?? true),

        ])
        ->except(['default','default-styling','default-colors'])
    }}
>
    {{ $slot }}
</tr>
