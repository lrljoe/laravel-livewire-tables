@aware([ 'tableName','isTailwind','isBootstrap','rowIndex'])
@props(['hidden' => false])
@if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
    @php($collapsingColumnButtonExpandAttributes= $this->getCollapsingColumnButtonExpandAttributes())
    @php($collapsingColumnButtonCollapseAttributes= $this->getCollapsingColumnButtonCollapseAttributes())

    <td x-data="{open:false}" wire:key="{{ $tableName }}-collapsingIcon-{{ $rowIndex }}-{{ md5(now()) }}"
        {{
            $attributes
                ->merge()
                ->class($isTailwind ? [
                    'p-3 table-cell text-center',
                    'sm:hidden' => !$this->shouldCollapseAlways() && !$this->shouldCollapseOnTablet(),
                    'md:hidden' => !$this->shouldCollapseAlways() && !$this->shouldCollapseOnTablet() && $this->shouldCollapseOnMobile(),
                    'lg:hidden' => !$this->shouldCollapseAlways() && ($this->shouldCollapseOnTablet() || $this->shouldCollapseOnMobile()),
                ] :
                [
                    'd-sm-none' => !$this->shouldCollapseAlways() && !$this->shouldCollapseOnTablet(),
                    'd-md-none' => !$this->shouldCollapseAlways() && !$this->shouldCollapseOnTablet() && $this->shouldCollapseOnMobile(),
                    'd-lg-none' => !$this->shouldCollapseAlways() && ($this->shouldCollapseOnTablet() || $this->shouldCollapseOnMobile()),

                ])
        }}
        :class="currentlyReorderingStatus ? 'laravel-livewire-tables-reorderingMinimised' : ''"
    >
        @if (! $hidden)
            <button
                x-cloak x-show="!currentlyReorderingStatus"
                x-on:click.prevent="$dispatch('toggle-row-content', {'tableName': '{{ $tableName }}', 'row': {{ $rowIndex }}}); open = !open"
                @class([
                    'border-0 bg-transparent p-0' => $isBootstrap
                ])
            >
                <x-heroicon-o-plus-circle x-cloak x-show="!open" {{ 
                    $attributes->merge($collapsingColumnButtonExpandAttributes)
                        ->class($isTailwind ?
                        [
                            'h-6 w-6' => ($collapsingColumnButtonExpandAttributes['default-styling'] ?? true),
                            'text-green-600' => ($collapsingColumnButtonExpandAttributes['default-colors'] ?? true),
                        ] :
                        [
                            'laravel-livewire-tables-btn-lg text-success' => ($collapsingColumnButtonExpandAttributes['default-colors'] ?? true)

                        ])
                        ->except(['default','default-styling','default-colors']) 
                    }}
                />
                <x-heroicon-o-minus-circle x-cloak x-show="open"  {{ 
                    $attributes->merge($collapsingColumnButtonCollapseAttributes)
                        ->class($isTailwind ? 
                        [
                            'h-6 w-6' => ($collapsingColumnButtonCollapseAttributes['default-styling'] ?? true),
                            'text-yellow-600' => ($collapsingColumnButtonCollapseAttributes['default-colors'] ?? true),
                        ] : [
                            'laravel-livewire-tables-btn-lg text-warning' => ($collapsingColumnButtonExpandAttributes['default-colors'] ?? true),
                        ])
                        ->except(['default','default-styling','default-colors']) 
                    }}
                />
            </button>
        @endif 
    </td>
@endif
