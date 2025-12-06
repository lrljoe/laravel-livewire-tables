@aware(['isTailwind', 'isTailwind4', 'isBootstrap'])
@props(['direction' => 'none', 'customIconAttributes'])
<span @class([
        'relative flex items-center' => $isTailwind || $isTailwind4,
        'w-5 h-5' =>  ($isTailwind || $isTailwind4) && ($customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true)),
        'relative d-flex align-items-center' => $isBootstrap
    ])
>
    @if($isTailwind || $isTailwind4)
        <x-livewire-tables::icons.sort.up x-cloak x-show="isAsc" />
        <x-livewire-tables::icons.sort.down_hover x-cloak x-show="isAsc" />
        <x-livewire-tables::icons.sort.down x-cloak x-show="isDesc" />
        <x-livewire-tables::icons.sort.clear x-cloak x-show="isDesc" />
        <x-livewire-tables::icons.sort.unsorted x-cloak x-show="isUnsorted" />
        <x-livewire-tables::icons.sort.up_hover x-cloak x-show="isUnsorted" />
    @else
        @switch($direction)
            @case('asc')
                <x-livewire-tables::icons.sort.up />
            @break
            @case('desc')
                <x-livewire-tables::icons.sort.down />
            @break
            @default
                <x-livewire-tables::icons.sort.unsorted />
        @endswitch
    @endif
</span>
