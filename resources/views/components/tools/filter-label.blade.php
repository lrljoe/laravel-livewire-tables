@aware([ 'tableName', 'isTailwind', 'isTailwind4', 'isBootstrap', 'isBootstrap4', 'isBootstrap5'])
@props(['filter', 'filterLayout' => 'popover', 'for' => null])

@php
    $filterLabelAttributes = $filter->getFilterLabelAttributes();
    $customLabelAttributes = $filter->getLabelAttributes();
@endphp

@if($filter->hasCustomFilterLabel() && !$filter->hasCustomPosition())
    @include($filter->getCustomFilterLabel(),['filter' => $filter, 'filterLayout' => $filterLayout, 'tableName' => $tableName, 'isTailwind' => $isTailwind, 'isTailwind4' => $isTailwind4, 'isBootstrap' => $isBootstrap, 'isBootstrap4' => $isBootstrap4, 'isBootstrap5' => $isBootstrap5, 'customLabelAttributes' => $customLabelAttributes])
@elseif(!$filter->hasCustomPosition())
    <label for="{{ $for ?? $tableName.'-filter-'.$filter->getKey() }}" {{
            $attributes->merge($customLabelAttributes)->merge($filterLabelAttributes)
                ->class([
                    'block text-sm font-medium leading-5' => ($isTailwind && ($filterLabelAttributes['default-styling'] ?? ($filterLabelAttributes['default'] ?? true))),
                    'text-gray-700 dark:text-white' => ($isTailwind && ($filterLabelAttributes['default-colors'] ?? ($filterLabelAttributes['default'] ?? true))),
                    'tw4ph block text-sm font-medium leading-5' => ($isTailwind4 && ($filterLabelAttributes['default-styling'] ?? ($filterLabelAttributes['default'] ?? true))),
                    'tw4ph text-gray-700 dark:text-white' => ($isTailwind4 && ($filterLabelAttributes['default-colors'] ?? ($filterLabelAttributes['default'] ?? true))),
                    'd-block' => ($isBootstrap && $filterLayout === 'slide-down' && ($filterLabelAttributes['default-styling'] ?? ($filterLabelAttributes['default'] ?? true))),
                    'mb-2' => ($isBootstrap && $filterLayout === 'popover' && ($filterLabelAttributes['default-styling'] ?? ($filterLabelAttributes['default'] ?? true))),
                ])
                ->except(['default', 'default-colors', 'default-styling'])
        }}
    >
        {{ $filter->getName() }}
    </label>
@endif
