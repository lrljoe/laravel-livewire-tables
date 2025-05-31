@aware([ 'tableName','isTailwind','isTailwind4', 'isBootstrap', 'toolBarAttributes'])
@props([])

<div
    {{
        $toolBarAttributes->merge()
        ->class([
            // Tailwind3
            'md:flex md:justify-between mb-4 px-4 md:p-0' => $isTailwind && ($toolBarAttributes['default-styling'] ?? true),

            // Tailwind4
            'md:flex md:justify-between mb-4 px-4 md:p-0' => $isTailwind4 && ($toolBarAttributes['default-styling'] ?? true),

            // Bootstrap
            'd-md-flex justify-content-between mb-3' => $isBootstrap && ($toolBarAttributes['default-styling'] ?? true),
        ])
        ->except(['default','default-styling','default-colors'])
    }}
>
    <div @class([
            // Tailwind 3
            'w-full mb-4 md:mb-0 md:w-2/4 md:flex space-y-4 md:space-y-0 md:space-x-2' => $isTailwind,
            
            // Tailwind 4
            'w-full mb-4 md:mb-0 md:w-2/4 md:flex space-y-4 md:space-y-0 md:space-x-2' => $isTailwind4,

            // Bootstrap
            'd-md-flex' => $isBootstrap,
        ])
    >
        @if ($this->hasConfigurableAreaFor('toolbar-left-start'))
            <div x-cloak x-show="!currentlyReorderingStatus" @class([
                // Tailwind 3
                'flex rounded-md shadow-sm' => $isTailwind,

                // Tailwind 4
                'flex rounded-md shadow-sm' => $isTailwind4,

                // Bootstrap
                'mb-3 mb-md-0 input-group' => $isBootstrap,
            ])>
                @include($this->getConfigurableAreaFor('toolbar-left-start'), $this->getParametersForConfigurableArea('toolbar-left-start'))
            </div>
        @endif

        @if ($this->showReorderButton())
            <x-livewire-tables::tools.toolbar.items.reorder-buttons />
        @endif

        @if ($this->showSearchField())
            <x-livewire-tables::tools.toolbar.items.search.search :searchViewAttributes="$this->getSearchViewAttributes()" />
        @endif

        @if ($this->showFiltersButton())
            <x-livewire-tables::tools.toolbar.items.filter-button />
        @endif

        @if($this->showActionsInToolbarLeft())
            <x-livewire-tables::includes.actions/>
        @endif

        @if ($this->hasConfigurableAreaFor('toolbar-left-end'))
            <div x-cloak x-show="!currentlyReorderingStatus" 
                @class([
                    // Tailwind 3
                    'flex rounded-md shadow-sm' => $isTailwind,

                    // Tailwind 4
                    'flex rounded-md shadow-sm' => $isTailwind4,

                    // Bootstrap
                    'mb-3 mb-md-0 input-group' => $isBootstrap,
                    ])
                >
                @include($this->getConfigurableAreaFor('toolbar-left-end'), $this->getParametersForConfigurableArea('toolbar-left-end'))
            </div>
        @endif
    </div>

    <div x-cloak x-show="!currentlyReorderingStatus"
        @class([
            // Tailwind 3
            'md:flex md:items-center space-y-4 md:space-y-0 md:space-x-2' => $isTailwind,

            // Tailwind 4
            'md:flex md:items-center space-y-4 md:space-y-0 md:space-x-2' => $isTailwind4,

            // Bootstrap
            'd-md-flex' => $isBootstrap,
        ])
    >
        @includeWhen($this->hasConfigurableAreaFor('toolbar-right-start'), $this->getConfigurableAreaFor('toolbar-right-start'), $this->getParametersForConfigurableArea('toolbar-right-start'))

        @if($this->showActionsInToolbarRight())
            <x-livewire-tables::includes.actions/>
        @endif

        @if ($this->showBulkActionsDropdownAlpine() && $this->shouldAlwaysHideBulkActionsDropdownOption != true)
            <x-livewire-tables::tools.toolbar.items.bulk-actions />
        @endif

        @if ($this->columnSelectIsEnabled())
            <x-livewire-tables::tools.toolbar.items.column-select />
        @endif

        @if ($this->showPaginationDropdown())
            <x-livewire-tables::tools.toolbar.items.pagination-dropdown />
        @endif

        @includeWhen($this->hasConfigurableAreaFor('toolbar-right-end'), $this->getConfigurableAreaFor('toolbar-right-end'), $this->getParametersForConfigurableArea('toolbar-right-end'))
    </div>
</div>

