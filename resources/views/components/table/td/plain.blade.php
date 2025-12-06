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
    ->class($isTailwind ? [
        'whitespace-wrap' => (!$wrapText && $isHtml) && ($customAttributes['default-styling'] ?? true),
        'whitespace-nowrap' => (!$wrapText && !$isHtml) && ($customAttributes['default-styling'] ?? true),
        'px-6 py-4 text-sm font-medium' => ($customAttributes['default-styling'] ?? true),
        'dark:text-white' => ($customAttributes['default-colors'] ?? true),
        'cursor-pointer' => ($isClickable && ($tableRowDetails['url'] !== null && ($tableRowDetails['attributes']['default'] ?? true))),
    ] : [])
    ->class($isTailwind4 ? [
        'whitespace-wrap' => (!$wrapText && $isHtml) && ($customAttributes['default-styling'] ?? true),
        'whitespace-nowrap' => (!$wrapText && !$isHtml) && ($customAttributes['default-styling'] ?? true),
        'px-6 py-4 text-sm font-medium' => ($customAttributes['default-styling'] ?? true),
        'dark:text-white' => ($customAttributes['default-colors'] ?? true),
        'cursor-pointer' => ($isClickable && ($tableRowDetails['url'] !== null && ($tableRowDetails['attributes']['default'] ?? true))),
    ] : [])
    ->class($isBootstrap ? [
        '' => ($customAttributes['default'] ?? true),
    ] : [])
    ->class($collapsingColumnInfo['collapsingColumnClasses'][$colIndex] ?? '')
    ->except(['default','default-styling','default-colors'])
}} @if($hideUntilReorder) x-show="reorderDisplayColumn" @endif >
    {{ $slot }}
</td>
