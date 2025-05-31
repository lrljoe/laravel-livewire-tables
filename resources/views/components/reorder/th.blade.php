@aware(['isTailwind','isTailwind4', 'isBootstrap', 'tableName'])
@php
    $customThAttributes = $this->hasReorderThAttributes() ? $this->getReorderThAttributes() : $this->getAllThAttributes($this->getReorderColumn())['customAttributes'];
@endphp

<x-livewire-tables::table.th.plain x-cloak x-show="currentlyReorderingStatus" wire:key="{{ $tableName }}-thead-reorder" :displayMinimisedOnReorder="false" 
    {{ 
        $attributes->merge($customThAttributes)
            ->class([
                // Tailwind 3
                'table-cell px-6 py-3 text-left text-xs font-medium whitespace-nowrap uppercase tracking-wider' => $isTailwind && (($customThAttributes['default-styling'] ?? true) || ($customThAttributes['default'] ?? true)),
                'text-gray-500 dark:bg-gray-800 dark:text-gray-400' => $isTailwind && (($customThAttributes['default-colors'] ?? true) || ($customThAttributes['default'] ?? true)),

                // Tailwind 4
                'table-cell px-6 py-3 text-left text-xs font-medium whitespace-nowrap uppercase tracking-wider' => $isTailwind4 && (($customThAttributes['default-styling'] ?? true) || ($customThAttributes['default'] ?? true)),
                'text-gray-500 dark:bg-gray-800 dark:text-gray-400' => $isTailwind4 && (($customThAttributes['default-colors'] ?? true) || ($customThAttributes['default'] ?? true)),

                // Bootstrap
                'laravel-livewire-tables-reorderingMinimised' => $isBootstrap && ($customThAttributes['default'] ?? true),
            ])
            ->except(['default','default-styling','default-colors'])
    }}
>
    <div x-cloak x-show="currentlyReorderingStatus"></div>
</x-livewire-tables::table.th.plain>

