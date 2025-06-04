@aware(['tableName','isBootstrap', 'isTailwind', 'isTailwind4'])
@props(['icon', 'hasIcon' => false, 'iconRight' => false])
<span {{ $attributes->merge()->class([
            'w-11/12 ',
            'order-1' => $hasIcon && $iconRight,
            'order-2' => $hasIcon && !$iconRight,
        ]) 
}}>
    {{ $slot }}
</span>