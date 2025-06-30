@aware(['dataTableFingerprint','isTailwind', 'isTailwind4', 'isBootstrap','isBootstrap4','isBootstrap5'])
@php($filterPopoverAttributes = $this->getFilterPopoverAttributes())

@if($isBootstrap)
    <ul x-cloak {{ $attributes
            ->merge($filterPopoverAttributes)
            ->merge(['role' => 'menu'])
            ->class([
                'w-100' => $filterPopoverAttributes['default-width'] ?? true,
                'dropdown-menu mt-md-5' => $isBootstrap4,
                'dropdown-menu' => $isBootstrap5,
            ]) }} x-bind:class="{ 'show': filterPopoverOpen }">

        @foreach ($this->getVisibleFilters() as $filter)
            <div id="{{ $dataTableFingerprint }}-filter-{{ $filter->getKey() }}-wrapper" wire:key="{{ $dataTableFingerprint }}-filter-{{ $filter->getKey() }}-toolbar" class="p-2">
                {{ $filter->render() }}
            </div>
        @endforeach

        @if ($this->hasAppliedVisibleFiltersWithValuesThatCanBeCleared())
            <div class='dropdown-divider'></div>
            <x-livewire-tables::tools.toolbar.items.filter-popover.clear-button />
        @endif
    </ul>
@elseif($isTailwind)
    <div wire:key="toolbaritem-filterpopover" x-cloak x-show="filterPopoverOpen" x-anchor.bottom-start="$refs.filterToolbarButton"
        {{ 
            $attributes
            ->merge($filterPopoverAttributes)
            ->merge([
                'role' => 'menu',
                'aria-orientation' => 'vertical',
                'aria-labelledby' => 'filters-menu',
                'x-transition:enter' => 'transition ease-out duration-100',
                'x-transition:enter-start' => 'transform opacity-0 scale-95',
                'x-transition:enter-end' => 'transform opacity-100 scale-100',
                'x-transition:leave' => 'transition ease-in duration-75',
                'x-transition:leave-start' => 'transform opacity-100 scale-100',
                'x-transition:leave-end' => 'transform opacity-0 scale-95',
            ])
            ->class([
                'w-full md:w-56' => $filterPopoverAttributes['default-width'] ?? true,
                'mt-2 rounded-md shadow-lg ring-1 ring-opacity-5 divide-y focus:outline-none z-50' => $filterPopoverAttributes['default-styling'] ?? true,
                'bg-white divide-gray-100 ring-black dark:bg-gray-700 dark:text-white dark:divide-gray-600' => $filterPopoverAttributes['default-colors'] ?? true,
            ])
            ->except(['x-cloak', 'x-show', 'default','default-width', 'default-styling','default-colors']) 
        }}>


        @foreach ($this->getVisibleFilters() as $filter)
            <div class="py-1" role="none">
                <div id="{{ $dataTableFingerprint }}-filter-{{ $filter->getKey() }}-wrapper" wire:key="{{ $dataTableFingerprint }}-filter-{{ $filter->getKey() }}-toolbar" class="block px-4 py-2 text-sm text-gray-700 space-y-1" role="menuitem">
                    {{ $filter->render() }}
                </div>
            </div>
        @endforeach


        @if ($this->hasAppliedVisibleFiltersWithValuesThatCanBeCleared())
            <div class="block px-4 py-3 text-sm text-gray-700 dark:text-white" role="menuitem">
                <x-livewire-tables::tools.toolbar.items.filter-popover.clear-button />
            </div>
        @endif
    </div>
@elseif($isTailwind4)
    <div x-cloak x-show="filterPopoverOpen"  x-anchor.bottom-start="$refs.filterToolbarButton"
        {{ 
            $attributes
            ->merge($filterPopoverAttributes)
            ->merge([
                'role' => 'menu',
                'aria-orientation' => 'vertical',
                'aria-labelledby' => 'filters-menu',
                'x-transition:enter' => 'transition ease-out duration-100',
                'x-transition:enter-start' => 'transform opacity-0 scale-95',
                'x-transition:enter-end' => 'transform opacity-100 scale-100',
                'x-transition:leave' => 'transition ease-in duration-75',
                'x-transition:leave-start' => 'transform opacity-100 scale-100',
                'x-transition:leave-end' => 'transform opacity-0 scale-95',
            ])
            ->class([
                'w-full md:w-56' => $filterPopoverAttributes['default-width'] ?? true,
                'mt-2 rounded-md shadow-lg ring-1 ring-opacity-5 divide-y focus:outline-none z-50' => $filterPopoverAttributes['default-styling'] ?? true,
                'bg-white divide-gray-100 ring-black dark:bg-gray-700 dark:text-white dark:divide-gray-600' => $filterPopoverAttributes['default-colors'] ?? true,
            ])
            ->except(['x-cloak', 'x-show', 'default','default-width', 'default-styling','default-colors']) 
        }}>


        @foreach ($this->getVisibleFilters() as $filter)
            <div id="{{ $dataTableFingerprint }}-filter-{{ $filter->getKey() }}-wrapper" wire:key="{{ $dataTableFingerprint }}-filter-{{ $filter->getKey() }}-toolbar" class="block px-4 py-3 text-sm text-gray-700 space-y-1" role="menuitem">
                {{ $filter->render() }}
            </div>
        @endforeach


        @if ($this->hasAppliedVisibleFiltersWithValuesThatCanBeCleared())
            <div class="block px-4 py-3 text-sm text-gray-700 dark:text-white" role="menuitem">
                <x-livewire-tables::tools.toolbar.items.filter-popover.clear-button />
            </div>
        @endif
    </div>

@endif