@aware([ 'rowIndex', 'rowID','isTailwind','isTailwind4','isBootstrap', 'collapsingColumnInfo'])
@props(['column' => null, 'isHtml' => false, 'wrapText' => false, 'isClickable' => false, 'colIndex' => null, 'customAttributes' => [], 'displayMinimisedOnReorder' => false, 'hideUntilReorder' => false])

<td  {{ $attributes
    ->merge($customAttributes)
    ->merge([
        'x-cloak' => $isTailwind || $isTailwind4
    ])
    ->class([
        'whitespace-wrap' => $wrapText && $isTailwind,
    ])
    ->class([
        'whitespace-wrap' => (!$wrapText && $isHtml) && $isTailwind && ($customAttributes['default-styling'] ?? true),
        'whitespace-nowrap' => (!$wrapText && !$isHtml) && $isTailwind && ($customAttributes['default-styling'] ?? true),
        'px-6 py-4 text-sm font-medium' => $isTailwind && ($customAttributes['default-styling'] ?? true),
        'dark:text-white' => $isTailwind && ($customAttributes['default-colors'] ?? true),
        'cursor-pointer' => $isTailwind && ($isClickable && ($tableRowDetails['url'] !== null && ($tableRowDetails['attributes']['default'] ?? true))),
        'tw4ph whitespace-wrap' => (!$wrapText && $isHtml) && $isTailwind4 && ($customAttributes['default-styling'] ?? true),
        'tw4ph whitespace-nowrap' => (!$wrapText && !$isHtml) && $isTailwind4 && ($customAttributes['default-styling'] ?? true),

        'tw4ph px-6 py-4 text-sm font-medium' => $isTailwind4 && ($customAttributes['default-styling'] ?? true),
        'tw4ph dark:text-white' => $isTailwind4 && ($customAttributes['default-colors'] ?? true),

        'tw4ph cursor-pointer' => $isTailwind4 && ($isClickable && ($tableRowDetails['url'] !== null && ($tableRowDetails['attributes']['default'] ?? true))),

        '' => $isBootstrap && ($customAttributes['default'] ?? true),
    ])
    ->class($collapsingColumnInfo['collapsingColumnClasses'][$colIndex] ?? '')
    ->except(['default','default-styling','default-colors'])
}} @if($hideUntilReorder) x-show="reorderDisplayColumn" @endif >
    {{ $slot }}
</td>
