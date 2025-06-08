@aware(['isTailwind','isTailwind4', 'isBootstrap'])

<div {{
    $attributes->merge($this->getToolsAttributes)->merge(['x-data' => 'tools($wire)'])
        ->class([
            'flex-col' => ($isTailwind && ($this->getToolsAttributes['default-styling'] ?? true)),
            'tw4ph flex-col' => ($isTailwind4 && ($this->getToolsAttributes['default-styling'] ?? true)),
            'd-flex flex-column' => $isBootstrap && ($this->getToolsAttributes['default-styling'] ?? true),
        ])
        ->except(['default','default-styling','default-colors'])
    }}
>
    @if ($this->showSortPillsSection())
        <x-livewire-tables::tools.sorting-pills />
    @endif

    @if(method_exists($this, 'showFilterPillsSection') ? $this->showFilterPillsSection() : false)
        <x-livewire-tables::tools.filter-pills />
    @endif

    @includeWhen(
        $this->hasConfigurableAreaFor('before-toolbar'),
        $this->getConfigurableAreaFor('before-toolbar'),
        $this->getParametersForConfigurableArea('before-toolbar')
    )

    @if($this->shouldShowToolBar())
        <x-livewire-tables::tools.toolbar  />
    @endif

    @if ($this->shouldShowToolsFilterSection())
        <x-livewire-tables::tools.toolbar.items.filter-slidedown  />
    @endif
    
    @includeWhen(
        $this->hasConfigurableAreaFor('after-toolbar'),
        $this->getConfigurableAreaFor('after-toolbar'),
        $this->getParametersForConfigurableArea('after-toolbar')
    )

</div>

