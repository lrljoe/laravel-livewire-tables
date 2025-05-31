@aware(['isTailwind','isTailwind4', 'isBootstrap'])
@props(['toolsAttributes', 'toolBarAttributes'])


    <div {{
        $attributes->merge(['x-data' => 'tools($wire)'])->merge($toolsAttributes)
            ->class([
                // Tailwind3
                'flex-col' => $isTailwind && ($toolsAttributes['default-styling'] ?? true),

                // Tailwind4
                'flex-col' => $isTailwind4 && ($toolsAttributes['default-styling'] ?? true),

                // Bootstrap
                'd-flex flex-column' => $isBootstrap && ($toolsAttributes['default-styling'] ?? true),
            ])
            ->except(['default','default-styling','default-colors'])
        }}
    >
        @if ($this->showSortPillsSection())
            <x-livewire-tables::tools.sorting-pills />
        @endif
        @if($this->showFilterPillsSection())
            <x-livewire-tables::tools.filter-pills />
        @endif

        @includeWhen(
            $this->hasConfigurableAreaFor('before-toolbar'),
            $this->getConfigurableAreaFor('before-toolbar'),
            $this->getParametersForConfigurableArea('before-toolbar')
        )

        @if($this->shouldShowToolBar())
            <x-livewire-tables::tools.toolbar />
        @endif
        @if (
            $this->filtersAreEnabled() &&
            $this->filtersVisibilityIsEnabled() &&
            $this->hasVisibleFilters() &&
            $this->isFilterLayoutSlideDown()
        )
            <x-livewire-tables::tools.toolbar.items.filter-slidedown  />
        @endif
        @includeWhen(
            $this->hasConfigurableAreaFor('after-toolbar'),
            $this->getConfigurableAreaFor('after-toolbar'),
            $this->getParametersForConfigurableArea('after-toolbar')
        )

    </div>

