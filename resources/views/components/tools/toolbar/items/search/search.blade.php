@aware(['isTailwind', 'isTailwind4', 'isBootstrap'])
@props(['searchViewAttributes'])

<div 
    @class([
        'mb-3 mb-md-0 input-group' => $isBootstrap,
        'rounded-md shadow-sm' => $isTailwind,
        'flex' => ($isTailwind && !$searchViewAttributes['icon']['hasSearchIcon']),
        'tw4ph rounded-md shadow-sm' => $isTailwind4,
        'tw4ph flex' => ($isTailwind4 && !$searchViewAttributes['icon']['hasSearchIcon']),
        'relative inline-flex flex-row' => $searchViewAttributes['icon']['hasSearchIcon'],
    ])>

        @if($searchViewAttributes['icon']['hasSearchIcon'])
            <x-livewire-tables::tools.toolbar.items.search.icon :searchIcon="$searchViewAttributes['icon']['searchIcon']" :searchIconClasses="$searchViewAttributes['icon']['classes']" :searchIconOtherAttributes="$searchViewAttributes['icon']['otherAttributes']"  />
        @endif

        <x-livewire-tables::tools.toolbar.items.search.input />

        @if ($searchViewAttributes['hasSearch'])
            <x-livewire-tables::tools.toolbar.items.search.remove />
        @endif
</div>
