@aware([ 'tableName','isTailwind','isTailwind4','isBootstrap','rowIndex', 'collapsingColumnInfo'])
@props(['hidden' => false])

    <td x-data="{open:false}" wire:key="{{ $tableName }}-collapsingIcon-{{ $rowIndex }}-{{ md5(now()) }}"
        {{
            $attributes
                ->merge()
                ->class([
                    'p-3 table-cell text-center' => $isTailwind,
                    'sm:hidden' => $isTailwind && (!($collapsingColumnInfo['shouldCollapseAlways'] ?? false) && !($collapsingColumnInfo['shouldCollapseOnTablet'] ?? false)),
                    'md:hidden' => $isTailwind && (!($collapsingColumnInfo['shouldCollapseAlways'] ?? false) && !($collapsingColumnInfo['shouldCollapseOnTablet'] ?? false) && ($collapsingColumnInfo['shouldCollapseOnMobile'] ?? false)),
                    'lg:hidden' => $isTailwind && (!($collapsingColumnInfo['shouldCollapseAlways'] ?? false) && (($collapsingColumnInfo['shouldCollapseOnTablet'] ?? false) || ($collapsingColumnInfo['shouldCollapseOnMobile'] ?? false))),

                    'd-sm-none' => $isBootstrap && (!($collapsingColumnInfo['shouldCollapseAlways'] ?? false) && !($collapsingColumnInfo['shouldCollapseOnTablet'] ?? false)),
                    'd-md-none' => $isBootstrap && (!($collapsingColumnInfo['shouldCollapseAlways'] ?? false) && !($collapsingColumnInfo['shouldCollapseOnTablet'] ?? false) && ($collapsingColumnInfo['shouldCollapseOnMobile'] ?? false)),
                    'd-lg-none' => $isBootstrap && (!($collapsingColumnInfo['shouldCollapseAlways'] ?? false) && (($collapsingColumnInfo['shouldCollapseOnTablet'] ?? false) || ($collapsingColumnInfo['shouldCollapseOnMobile'] ?? false))),

                ])
        }}
        :class="currentlyReorderingStatus ? 'laravel-livewire-tables-reorderingMinimised' : ''"
    >
        @if (! $hidden)
            <button
                x-cloak x-show="!currentlyReorderingStatus"
                @mouseover="if(opening != true) { opening = true }; "
                x-on:click.prevent="if(opening != true) { opening = true }; $dispatch('toggle-row-content', {'tableName': '{{ $tableName }}', 'row': {{ $rowIndex }}}); open = !open;"
                @class([
                    'w-full h-full',
                    'border-0 bg-transparent p-0' => $isBootstrap,
                ])
            >
                <x-heroicon-o-plus-circle x-cloak x-show="!open" {{ 
                    $attributes->merge($collapsingColumnInfo['buttonExpandAttributes'])
                        ->class([
                            'h-6 w-6' => $isTailwind && ($collapsingColumnInfo['buttonExpandAttributes']['default-styling'] ?? true),
                            'text-green-600' => $isTailwind && ($collapsingColumnInfo['buttonExpandAttributes']['default-colors'] ?? true),

                            'laravel-livewire-tables-btn-lg text-success' => $isBootstrap && ($collapsingColumnInfo['buttonExpandAttributes']['default-colors'] ?? true),                           
                        ])
                        ->except(['default','default-styling','default-colors']) 
                    }}
                />
                <x-heroicon-o-minus-circle x-cloak x-show="open"  {{ 
                    $attributes->merge($collapsingColumnInfo['buttonCollapseAttributes'])
                        ->class([
                            'h-6 w-6' => $isTailwind && ($collapsingColumnInfo['buttonCollapseAttributes']['default-styling'] ?? true),
                            'text-yellow-600' => $isTailwind && ($collapsingColumnInfo['buttonCollapseAttributes']['default-colors'] ?? true),


                            'laravel-livewire-tables-btn-lg text-warning' => $isBootstrap && ($collapsingColumnInfo['buttonCollapseAttributes']['default-colors'] ?? true),
                        ])
                        ->except(['default','default-styling','default-colors']) 
                    }}
                />
            </button>
        @endif 
    </td>