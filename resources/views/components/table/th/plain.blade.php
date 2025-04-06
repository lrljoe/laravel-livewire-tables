@aware(['isTailwind', 'isBootstrap'])
@props(['displayMinimisedOnReorder' => false, 'hideUntilReorder' => false, 'customAttributes' => ['default' => true]])

<th x-cloak scope="col" @if($hideUntilReorder) :class="!reorderDisplayColumn && 'w-0 p-0 hidden'" @endif {{ 
        $attributes->merge($customAttributes)->class($isTailwind ? [
            'table-cell px-3 py-2 md:px-6 md:py-3 text-center md:text-left laravel-livewire-tables-reorderingMinimised' => (($customAttributes['default-styling'] ?? true) || ($customAttributes['default'] ?? true)),
            'bg-gray-50 dark:bg-gray-800' => (($customAttributes['default-colors'] ?? true) || ($customAttributes['default'] ?? true)),
        ] : [
            'laravel-livewire-tables-reorderingMinimised' => (($customAttributes['default-colors'] ?? true) || ($customAttributes['default'] ?? true)),
        ])->except(['default','default-styling','default-colors'])
}}>
    {{ $slot }}
</th>
