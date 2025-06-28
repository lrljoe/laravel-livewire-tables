@aware(['dataTableFingerprint'])

@php
    $filterKey = $filter->getKey();
@endphp

<div x-cloak id="{{ $dataTableFingerprint }}-dateRangeFilter-{{ $filterKey }}" x-data="flatpickrFilter($wire, '{{ $filterKey }}', @js($filter->getConfigs()), $refs.dateRangeInput, '{{ App::currentLocale() }}')" >
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout  :$filterLabelAttributes :$customLabelAttributes />
    <div @class([
            'w-full rounded-md shadow-sm text-left' => $isTailwind,
            'tw4ph w-full rounded-md shadow-sm text-left' => $isTailwind4,
            'd-inline-block w-100 mb-3 mb-md-0 input-group' => $isBootstrap,
        ])
    >
        <input
            type="text"
            x-ref="dateRangeInput"
            x-on:click="init"
            x-on:change="changedValue($refs.dateRangeInput.value)"
            value="{{ $filter->getDateString(array_key_exists($filterKey, $this->appliedFilters) ? $this->appliedFilters[$filterKey] : '') }}"
            wire:key="{{ $filter->generateWireKey($dataTableFingerprint, 'dateRange') }}"
            id="{{ $dataTableFingerprint }}-filter-dateRange-{{ $filterKey }}"
            @class([
                'w-full inline-block align-middle transition duration-150 ease-in-out border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600' => $isTailwind,
                'tw4ph w-full inline-block align-middle transition duration-150 ease-in-out border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600' => $isTailwind4,
                'd-inline-block w-100 form-control' => $isBootstrap,
            ])
            @if($filter->hasConfig('placeholder')) placeholder="{{ $filter->getConfig('placeholder') }}" @endif
        />
    </div>
</div>
