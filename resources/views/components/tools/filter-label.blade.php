@aware([ 'dataTableFingerprint', 'isTailwind', 'isTailwind4', 'isBootstrap', 'isBootstrap4', 'isBootstrap5'])
@props(['filter', 'filterLabelAttributes' => [], 'customLabelAttributes' => [], 'filterLayout' => 'popover', 'for' => null])


@if($filter->hasCustomFilterLabel() && !$filter->hasCustomPosition())
    @include($filter->getCustomFilterLabel(),['filter' => $filter, 'filterLayout' => $filterLayout, 'dataTableFingerprint' => $dataTableFingerprint, 'isTailwind' => $isTailwind, 'isTailwind4' => $isTailwind4, 'isBootstrap' => $isBootstrap, 'isBootstrap4' => $isBootstrap4, 'isBootstrap5' => $isBootstrap5, 'customLabelAttributes' => $customLabelAttributes])
@elseif(!$filter->hasCustomPosition())
    <label for="{{ $for ?? $dataTableFingerprint.'-filter-'.$filter->getKey() }}" {{
            $attributes->merge($customLabelAttributes)->merge($filterLabelAttributes)
                ->class([
                    'w-11/12 text-wrap block text-sm font-medium leading-5' => ($isTailwind && ($filterLabelAttributes['default-styling'] ?? ($filterLabelAttributes['default'] ?? true))),
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
