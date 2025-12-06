@aware(['isTailwind','isTailwind4','isBootstrap','isBootstrap4','isBootstrap5'])
<div x-data="{ open: false, childElementOpen: false }" x-cloak 
    @class([
        'w-full md:w-auto mb-4 md:mb-0' => $isTailwind,
        'tw4ph w-full md:w-auto mb-4 md:mb-0' => $isTailwind4,
        'mb-3 mb-md-0' => $isBootstrap,
    ])
>
    <div @class([
            'relative inline-block text-left z-10 w-full md:w-auto' => $isTailwind,
            'tw4ph relative inline-block text-left z-10 w-full md:w-auto' => $isTailwind4,
            'dropdown d-block d-md-inline' => $isBootstrap,
        ])
    >
        {{ $slot }}
    </div>
</div>