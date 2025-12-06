@aware([ 'dataTableFingerprint','isTailwind','isTailwind4','isBootstrap','rowIndex', 'collapsingColumnInfo'])
@props(['hidden' => false])

<td x-data="{open:false}" wire:key="{{ $dataTableFingerprint }}-collapsingIcon-{{ $rowIndex }}-{{ md5(now()) }}"
    {{
        $attributes
            ->merge()
            ->class($isTailwind ? [
                'p-3 table-cell text-center',
                'sm:hidden' => (!($collapsingColumnInfo['shouldCollapseAlways'] ?? false) && !($collapsingColumnInfo['shouldCollapseOnTablet'] ?? false)),
                'md:hidden' => (!($collapsingColumnInfo['shouldCollapseAlways'] ?? false) && !($collapsingColumnInfo['shouldCollapseOnTablet'] ?? false) && ($collapsingColumnInfo['shouldCollapseOnMobile'] ?? false)),
                'lg:hidden' => (!($collapsingColumnInfo['shouldCollapseAlways'] ?? false) && (($collapsingColumnInfo['shouldCollapseOnTablet'] ?? false) || ($collapsingColumnInfo['shouldCollapseOnMobile'] ?? false))),

            ] : [])
            ->class($isTailwind4 ? [
                'tw4ph p-3 table-cell text-center',
                'tw4ph sm:hidden' => (!($collapsingColumnInfo['shouldCollapseAlways'] ?? false) && !($collapsingColumnInfo['shouldCollapseOnTablet'] ?? false)),
                'tw4ph md:hidden' => (!($collapsingColumnInfo['shouldCollapseAlways'] ?? false) && !($collapsingColumnInfo['shouldCollapseOnTablet'] ?? false) && ($collapsingColumnInfo['shouldCollapseOnMobile'] ?? false)),
                'tw4ph lg:hidden' => (!($collapsingColumnInfo['shouldCollapseAlways'] ?? false) && (($collapsingColumnInfo['shouldCollapseOnTablet'] ?? false) || ($collapsingColumnInfo['shouldCollapseOnMobile'] ?? false))),

            ] : [])
            ->class($isBootstrap ? [
                'd-sm-none' => (!($collapsingColumnInfo['shouldCollapseAlways'] ?? false) && !($collapsingColumnInfo['shouldCollapseOnTablet'] ?? false)),
                'd-md-none' => (!($collapsingColumnInfo['shouldCollapseAlways'] ?? false) && !($collapsingColumnInfo['shouldCollapseOnTablet'] ?? false) && ($collapsingColumnInfo['shouldCollapseOnMobile'] ?? false)),
                'd-lg-none' => (!($collapsingColumnInfo['shouldCollapseAlways'] ?? false) && (($collapsingColumnInfo['shouldCollapseOnTablet'] ?? false) || ($collapsingColumnInfo['shouldCollapseOnMobile'] ?? false))),

            ] : [])
    }}
    :class="currentlyReorderingStatus ? 'laravel-livewire-tables-reorderingMinimised' : ''"
>
    @if (! $hidden)
        <button
            x-cloak x-show="!currentlyReorderingStatus"
            @mouseover="if(opening != true) { opening = true }; "
            x-on:click.prevent="if(opening != true) { opening = true }; $dispatch('toggle-row-content', {'dataTableFingerprint': '{{ $dataTableFingerprint }}', 'row': {{ $rowIndex }}}); open = !open;"
            @class([
                'w-full h-full',
                'border-0 bg-transparent p-0' => $isBootstrap,
            ])
        >
            <x-heroicon-o-plus-circle x-cloak x-show="!open" {{ 
                $attributes->merge($collapsingColumnInfo['buttonExpandAttributes'])
                    ->class($isTailwind ? [
                        'h-6 w-6' => ($collapsingColumnInfo['buttonExpandAttributes']['default-styling'] ?? true),
                        'text-green-600' => ($collapsingColumnInfo['buttonExpandAttributes']['default-colors'] ?? true),
                    ] : [])
                    ->class($isTailwind4 ? [
                        'tw4ph h-6 w-6' => ($collapsingColumnInfo['buttonExpandAttributes']['default-styling'] ?? true),
                        'tw4ph text-green-600' => ($collapsingColumnInfo['buttonExpandAttributes']['default-colors'] ?? true),
                    ] : [])
                    ->class($isBootstrap ? [
                        'laravel-livewire-tables-btn-lg text-success' => ($collapsingColumnInfo['buttonExpandAttributes']['default-colors'] ?? true),                           
                    ] : [])
                    ->except(['default','default-styling','default-colors']) 
                }}
            />
            <x-heroicon-o-minus-circle x-cloak x-show="open"  {{ 
                $attributes->merge($collapsingColumnInfo['buttonCollapseAttributes'])
                    ->class($isTailwind ? [
                        'h-6 w-6' => ($collapsingColumnInfo['buttonCollapseAttributes']['default-styling'] ?? true),
                        'text-yellow-600' => ($collapsingColumnInfo['buttonCollapseAttributes']['default-colors'] ?? true),
                    ] : [])
                    ->class($isTailwind4 ? [
                        'tw4ph h-6 w-6' => ($collapsingColumnInfo['buttonCollapseAttributes']['default-styling'] ?? true),
                        'tw4ph text-yellow-600' =>($collapsingColumnInfo['buttonCollapseAttributes']['default-colors'] ?? true),
                    ] : [])
                    ->class($isBootstrap ? [
                        'laravel-livewire-tables-btn-lg text-warning' => ($collapsingColumnInfo['buttonCollapseAttributes']['default-colors'] ?? true),
                    ] : [])
                    ->except(['default','default-styling','default-colors']) 
                }}
            />
        </button>
    @endif 
</td>