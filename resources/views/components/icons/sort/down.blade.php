@aware(['direction' => 'none', 'customIconAttributes', 'isTailwind', 'isTailwind4', 'isBootstrap'])
<x-heroicon-c-chevron-down {{ $attributes->merge($customIconAttributes)
    ->class($isTailwind ? [
        'absolute opacity-100 group-hover:opacity-0' => ($customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true)),
    ] : [])
    ->class($isTailwind4 ? [
        'absolute opacity-100 group-hover:opacity-0' => ($customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true)),
    ] : [])
    ->class($isBootstrap ? [
        'laravel-livewire-tables-btn-smaller ms-1' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
    ] : [])
    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }}   />