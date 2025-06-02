<a {{ $attributes->merge()
            ->class([
                'w-full text-left' => $isTailwind && $isInMenu,
                'text-center' => $isTailwind && !$isInMenu,
                'justify-center items-center inline-flex flex-cols gap-2 rounded-md border shadow-sm px-4 py-2 text-sm font-medium focus:ring focus:ring-opacity-50' => $isTailwind && ($attributes['default-styling'] ?? true),
                'focus:border-indigo-300 focus:ring-indigo-200' => $isTailwind && ($attributes['default-colors'] ?? true),
                'btn btn-sm btn-success' => $isBootstrap && ($attributes['default-styling'] ?? true),
                '' => $isBootstrap && ($attributes['default-colors'] ?? true),
            ])
            ->except(['default','default-styling','default-colors'])
        }}
        @if($action->hasWireAction())
        {{ $action->getWireAction() }}="{{ $action->getWireActionParams() }}"
        @endif
        @if($action->getWireNavigateEnabled())
        wire:navigate
        @endif
>
    @if($action->hasIcon())
        <span @class([
            'w-1/12',
            'order-1 inline-block ' => !$action->getIconRight(),
            'order-2 inline-block mr-2' => $action->getIconRight()
        ])>
            <i {{ $action->getIconAttributes()
                    ->class([
                        'ms-1 '. $action->getIcon() => $isBootstrap,
                        'ml-1 '. $action->getIcon() => $isTailwind && $action->getIconRight(),
                        'pr-1 '. $action->getIcon() => $isTailwind && !$action->getIconRight(),
                    ])
                    ->except(['default','default-styling','default-colors'])
                }}
            ></i>
        </span>
    @endif
    <span {{ $action->getLabelAttributesBag()->merge()->class([
        'w-11/12 ',
        'order-1' => $action->hasIcon() && $action->getIconRight(),
        'order-2' => $action->hasIcon() && !$action->getIconRight(),
    ]) }}>
        {{ $action->getLabel() }}
    </span>
</a>
