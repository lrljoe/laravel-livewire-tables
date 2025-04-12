@aware([ 'tableName','isTailwind','isBootstrap','rowIndex', 'collapsingColumnButtonExpandAttributes','collapsingColumnButtonCollapseAttributes','hasCollapsingColumns', 'shouldCollapseAlways','shouldCollapseOnTablet','shouldCollapseOnMobile'])
@props(['hidden' => false])
@if ($hasCollapsingColumns)

    <td x-data="{open:false}" wire:key="{{ $tableName }}-collapsingIcon-{{ $rowIndex }}-{{ md5(now()) }}"
        {{
            $attributes
                ->merge()
                ->class($isTailwind ? [
                    'p-3 table-cell text-center',
                    'sm:hidden' => !$shouldCollapseAlways && !$shouldCollapseOnTablet,
                    'md:hidden' => !$shouldCollapseAlways && !$shouldCollapseOnTablet && $shouldCollapseOnMobile,
                    'lg:hidden' => !$shouldCollapseAlways && ($shouldCollapseOnTablet || $shouldCollapseOnMobile),
                ] :
                [
                    'd-sm-none' => !$shouldCollapseAlways && !$shouldCollapseOnTablet,
                    'd-md-none' => !$shouldCollapseAlways && !$shouldCollapseOnTablet && $shouldCollapseOnMobile,
                    'd-lg-none' => !$shouldCollapseAlways && ($shouldCollapseOnTablet || $shouldCollapseOnMobile),

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
