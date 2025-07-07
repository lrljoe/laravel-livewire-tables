@aware([ 'rowIndex', 'rowID','isTailwind','isTailwind4','isBootstrap', 'collapsingColumnInfo'])
@props(['column' => null, 'isHtml' => false, 'wrapText' => false, 'colIndex' => null, 'customAttributes' => [], 'displayMinimisedOnReorder' => false, 'hideUntilReorder' => false])

<td  {{ $attributes
    ->merge($customAttributes)
    ->merge([
        'x-cloak' => $isTailwind || $isTailwind4
    ])
    ->class([
        'px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $isTailwind && ($customAttributes['default'] ?? true),
        'tw4ph px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $isTailwind4 && ($customAttributes['default'] ?? true),
        
        'whitespace-wrap' => ($wrapText || $isHtml) && $isTailwind && ($customAttributes['default'] ?? true),
        'whitespace-nowrap' => (!$wrapText && !$isHtml) && $isTailwind && ($customAttributes['default'] ?? true),

        'px-6 py-4  text-sm font-medium dark:text-white' => $isTailwind && ($customAttributes['default'] ?? true),

        '' => $isBootstrap && ($customAttributes['default'] ?? true),
    ])
    ->class($collapsingColumnInfo['collapsingColumnClasses'][$colIndex] ?? '')
    ->except(['default','default-styling','default-colors'])
}} @if($hideUntilReorder) x-show="reorderDisplayColumn" @endif >
    {{ $slot }}
</td>
