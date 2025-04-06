@aware([ 'rowIndex', 'rowID','isTailwind','isBootstrap'])
@props(['column' => null, 'customAttributes' => [], 'displayMinimisedOnReorder' => false, 'hideUntilReorder' => false])

<td  {{ $attributes
    ->merge($customAttributes)
    ->merge([
        'x-cloak' => $isTailwind
    ])
    ->class($isTailwind ? [
        'px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $customAttributes['default'] ?? true,
        'hidden' => $column && $column->shouldCollapseAlways(),
        'hidden md:table-cell' => $column && $column->shouldCollapseOnMobile(),
        'hidden lg:table-cell' => $column && $column->shouldCollapseOnTablet(),
    ] : [
        '' => $customAttributes['default'] ?? true,
        'd-none' => $column && $column->shouldCollapseAlways(),
        'd-none d-md-table-cell' => $column && $column->shouldCollapseOnMobile(),
        'd-none d-lg-table-cell' => $column && $column->shouldCollapseOnTablet(),
    ])
    ->except(['default','default-styling','default-colors'])
}} @if($hideUntilReorder) x-show="reorderDisplayColumn" @endif >
    {{ $slot }}
</td>
