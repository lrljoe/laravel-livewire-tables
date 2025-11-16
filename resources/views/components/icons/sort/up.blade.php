@aware(['direction' => 'none', 'customIconAttributes', 'isTailwind', 'isTailwind4', 'isBootstrap'])
<x-heroicon-c-chevron-up {{ $attributes->merge($customIconAttributes)
    ->class($isTailwind ? [
        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
        'absolute opacity-100 group-hover:opacity-0',
    ] : [])
    ->class($isTailwind4 ? [
        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
        'absolute opacity-100 group-hover:opacity-0',
    ] : [])
    ->class($isBootstrap ? [
        'laravel-livewire-tables-btn-smaller ms-1' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
    ] : [])
    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }} />
