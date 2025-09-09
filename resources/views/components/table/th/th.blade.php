@aware(['isTailwind','isTailwind4','isBootstrap','collapsingColumnInfo', 'sortingIsEnabled', 'columnSortConfig'])
@props(['columnHash', 'index'])

@php
    $allThAttributes = $columnSortConfig[$columnHash];
    $customThAttributes = $allThAttributes['customAttributes'];
    $customSortButtonAttributes = $allThAttributes['sortButtonAttributes'];
    $customLabelAttributes = $allThAttributes['labelAttributes'];
    $customIconAttributes = $allThAttributes['sortIconAttributes'];
    $direction = $allThAttributes['direction'];
    $columnTitle = $allThAttributes['columnTitle'];
@endphp

<th {{
    $attributes->merge($customThAttributes)
        ->class([
            'text-gray-500 dark:bg-gray-800 dark:text-gray-400' => $isTailwind && (($customThAttributes['default-colors'] ?? true) || ($customThAttributes['default'] ?? true)),
            'px-6 py-3 text-left text-xs font-medium whitespace-nowrap uppercase tracking-wider' => $isTailwind && (($customThAttributes['default-styling'] ?? true) || ($customThAttributes['default'] ?? true)),
            
            'tw4ph text-gray-500 dark:bg-gray-800 dark:text-gray-400' => $isTailwind4 && (($customThAttributes['default-colors'] ?? true) || ($customThAttributes['default'] ?? true)),
            'tw4ph px-6 py-3 text-left text-xs font-medium whitespace-nowrap uppercase tracking-wider' => $isTailwind4 && (($customThAttributes['default-styling'] ?? true) || ($customThAttributes['default'] ?? true)),

            '' => $isBootstrap && ($customThAttributes['default'] ?? true),
        ])
        ->class($collapsingColumnInfo['collapsingColumnClasses'][$index] ?? '')
        ->except(['default', 'default-colors', 'default-styling'])
}}>
    @if($allThAttributes['labelStatus'])
        @unless ($sortingIsEnabled && ($allThAttributes['isSortable'] ?? false))
            <x-livewire-tables::table.th.label :$customLabelAttributes :$columnTitle />
        @else
            @if ($isTailwind || $isTailwind4)

                <button wire:click="sortBy('{{ $allThAttributes['columnSortKey'] }}')" {{
                        $attributes->merge($customSortButtonAttributes)
                            ->class([
                                'text-gray-500 dark:text-gray-400' => (($customSortButtonAttributes['default-colors'] ?? true) || ($customSortButtonAttributes['default'] ?? true)),
                                'flex items-center space-x-1 text-left text-xs leading-4 font-medium uppercase tracking-wider group focus:outline-none' => (($customSortButtonAttributes['default-styling'] ?? true) || ($customSortButtonAttributes['default'] ?? true)),
                            ])
                            ->except(['default', 'default-colors', 'default-styling', 'wire:key'])
                }}>
                    <x-livewire-tables::table.th.label :$customLabelAttributes :$columnTitle />
                    <x-livewire-tables::table.th.sort-icons :$direction :$customIconAttributes />
                </button>
            @elseif ($isBootstrap)
                <div wire:click="sortBy('{{ $allThAttributes['columnSortKey'] }}')" {{
                        $attributes->merge($customSortButtonAttributes)
                            ->class([
                                'd-flex align-items-center laravel-livewire-tables-cursor' => (($customSortButtonAttributes['default-styling'] ?? true) || ($customSortButtonAttributes['default'] ?? true))
                            ])
                            ->except(['default', 'default-colors', 'default-styling', 'wire:key'])
                }}>
                    <x-livewire-tables::table.th.label :$customLabelAttributes :$columnTitle />
                    <x-livewire-tables::table.th.sort-icons :$direction :$customIconAttributes />

                </div>
            @endif

        @endunless
    @endif
</th>
