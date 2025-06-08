@aware([ 'tableName','isTailwind','isTailwind4','isBootstrap','isBootstrap4','isBootstrap5', 'localisationPath'])
<div x-data="{ open: false, childElementOpen: false }"
        x-cloak x-show="(selectedItems.length > 0 || hideBulkActionsWhenEmpty == false)"
        @class([
            'w-full md:w-auto mb-4 md:mb-0' => $isTailwind,
            'tw4ph w-full md:w-auto mb-4 md:mb-0' => $isTailwind4,
            'mb-3 mb-md-0' => $isBootstrap,
        ])
    >
        <div @class([
                'flex-1 content-center items-center justify-center relative inline-block text-left z-10 w-full md:w-auto' => $isTailwind,
                'tw4ph relative inline-block text-left z-10 w-full md:w-auto' => $isTailwind4,
                'dropdown d-block d-md-inline' => $isBootstrap,
            ])
        >
            {{-- The Button Used To Toggle The Menu --}}
            <x-livewire-tables::bulk-actions.menu.button id="{{ $tableName }}-bulkActionsDropdownButton" aria-controls="{{ $tableName }}-bulkActionsDropdownBody" {{ $attributes->merge($this->getBulkActionsButtonAttributes) }} />
            
            {{-- The Body of The Menu --}}
            <x-livewire-tables::bulk-actions.menu.body id="{{ $tableName }}-bulkActionsDropdownBody" aria-labelledby="{{ $tableName }}-bulkActionsDropdownButton" {{ $attributes->merge($this->getBulkActionsMenuAttributes) }}>
                    @tableloop ($this->getBulkActionsButtons() as $id => $bulkAction)
                        {!! $bulkAction->render() !!}
                    @endtableloop
            </x-livewire-tables::bulk-actions.menu.body>

        </div>
</div>
