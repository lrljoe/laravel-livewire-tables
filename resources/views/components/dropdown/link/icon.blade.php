@aware(['tableName','isBootstrap', 'isTailwind', 'isTailwind4'])
@props(['icon', 'iconRight' => false])
<span @class([
    'w-1/12',
    'order-1 inline-block ' => !$iconRight,
    'order-2 inline-block mr-2' => $iconRight
])>
    <i {{ $attributes
            ->class([
                'ms-1 '. $icon => $isBootstrap,
                'ml-1 '. $icon => $isTailwind && $iconRight,
                'pr-1 '. $icon => $isTailwind && !$iconRight,
            ])
            ->except(['default','default-styling','default-colors'])
        }}
    ></i>
</span>