@aware(['isTailwind', 'isTailwind4', 'isBootstrap'])
<div 
    @class([
        'mb-3 mb-md-0 input-group' => $isBootstrap,
        'rounded-md shadow-sm' => $isTailwind,
        'flex' => ($isTailwind && !$icon['hasSearchIcon']),
        'tw4ph rounded-md shadow-sm' => $isTailwind4,
        'tw4ph flex' => ($isTailwind4 && !$icon['hasSearchIcon']),
        'relative inline-flex flex-row' => $icon['hasSearchIcon'],
    ])>

        @if($icon['hasSearchIcon'])
            <x-livewire-tables::tools.toolbar.items.search.icon :searchIcon="$icon['searchIcon']" :searchIconClasses="$icon['classes']" :searchIconOtherAttributes="$icon['otherAttributes']"  />
        @endif

        <x-livewire-tables::tools.toolbar.items.search.input :$searchOptions :$searchPlaceholder :$searchFieldAttributes :$hasSearch :$icon/>

        @if ($hasSearch)
            <x-livewire-tables::tools.toolbar.items.search.remove />
        @endif
</div>
