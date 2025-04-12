@aware(['isTailwind','isBootstrap'])
@props(['customAttributes' => [], 'displayMinimisedOnReorder' => true, 'rowIndex' => "-1" ])

<tr {{ $attributes
        ->merge($customAttributes)
        ->class($isTailwind ? [
            'laravel-livewire-tables-reorderingMinimised',
            'bg-white dark:bg-gray-700 dark:text-white' => ($customAttributes['default'] ?? true),
        ] : 
        [
            'laravel-livewire-tables-reorderingMinimised',
            '' => $customAttributes['default'] ?? true,
        ])
        ->except(['default','default-styling','default-colors'])
    }}
>
    {{ $slot }}
</tr>
