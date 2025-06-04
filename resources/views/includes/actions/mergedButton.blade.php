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
        @if($action->hasIcon())
            <x-livewire-tables::shared.icon :attributes="$action->getIconAttributes()" :iconRight="$action->getIconRight()" :icon="$action->getIcon()" />
        @endif

        <x-livewire-tables::shared.label :attributes="$action->getLabelAttributesBag()" :hasIcon="$action->hasIcon()" :iconRight="$action->getIconRight()">
            {{ $action->getLabel() }}
        </x-livewire-tables::shared.label>
</a>
