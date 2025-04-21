@aware([ 'rowIndex', 'rowID','isTailwind','isBootstrap','collapsingColumnClasses'])
@props(['column' => null, 'colIndex' => null, 'customAttributes' => [], 'displayMinimisedOnReorder' => false, 'hideUntilReorder' => false])

<td  {{ $attributes
    ->merge($customAttributes)
    ->merge([
        'x-cloak' => $isTailwind
    ])
    ->class($isTailwind ? [
        'px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $customAttributes['default'] ?? true,
    ] : [
        '' => $customAttributes['default'] ?? true,
    ])
    ->class($collapsingColumnClasses[$colIndex] ?? '')
    ->except(['default','default-styling','default-colors'])
}} @if($hideUntilReorder) x-show="reorderDisplayColumn" @endif >
    {{ $slot }}
</td>
