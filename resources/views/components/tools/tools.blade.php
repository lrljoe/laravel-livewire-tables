@aware(['isTailwind','isBootstrap'])
@php($toolsAttributes = $this->getToolsAttributes())

    @includeWhen(
        $this->hasConfigurableAreaFor('before-tools'),
        $this->getConfigurableAreaFor('before-tools'),
        $this->getParametersForConfigurableArea('before-tools')
    )

    <div {{
        $attributes->merge(['x-data' => 'tools($wire)'])->merge($toolsAttributes)
            ->class($isTailwind ? [
                'flex-col' => ($toolsAttributes['default-styling'] ?? true),
            ] : [
                'd-flex flex-column' => ($toolsAttributes['default-styling'] ?? true)
            ])
            ->except(['default','default-styling','default-colors'])
        }}
    >
    <div><div>Test124561</div>
    <div class="flex flex-row">
        <template x-for="(value, index) in internalFilterPillsVals">
            <div class="flex flex-col">
                <div><span x-text="index"></span></div>
                <div class="flex flex-row">

                    <template x-for="(value2, index2) in value">
                        <div class="flex flex-col">
                            <div><span x-text="index2"></span>:</div>
                            <div><span x-text="value2"></span></div>
                        </div>
                    </template>
                </div>
            </div>
    </template>
</ul>
</div>
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

    @includeWhen(
        $this->hasConfigurableAreaFor('after-tools'),
        $this->getConfigurableAreaFor('after-tools'),
        $this->getParametersForConfigurableArea('after-tools')
    )
