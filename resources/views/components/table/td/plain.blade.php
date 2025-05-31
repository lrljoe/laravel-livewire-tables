@aware([ 'rowIndex', 'rowID','isTailwind','isTailwind4','isBootstrap', 'collapsingColumnInfo'])
@props(['column' => null, 'colIndex' => null, 'customAttributes' => [], 'displayMinimisedOnReorder' => false, 'hideUntilReorder' => false])

<td  {{ $attributes
    ->merge($customAttributes)
    ->merge([
        'x-cloak' => $isTailwind || $isTailwind4
    ])
    ->class([
        // Tailwind 3
        'px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $isTailwind && ($customAttributes['default'] ?? true),

        // Tailwind 4
        'px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $isTailwind4 && ($customAttributes['default'] ?? true),

        // Bootstrap
        '' => $isBootstrap && ($customAttributes['default'] ?? true),
    ])
    ->class($collapsingColumnInfo['collapsingColumnClasses'][$colIndex] ?? '')
    ->except(['default','default-styling','default-colors'])
}} @if($hideUntilReorder) x-show="reorderDisplayColumn" @endif >
    {{ $slot }}
</td>
