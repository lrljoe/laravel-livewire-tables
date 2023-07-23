@php
    $theme = $component->getTheme();
    $filterLayout = $component->getFilterLayout();
    $tableName = $component->getTableName();
@endphp
<div>
    @if($filter->hasCustomFilterLabel() && !$filter->hasCustomPosition())
        @include($filter->getCustomFilterLabel(),['filter' => $filter, 'theme' => $theme, 'filterLayout' => $filterLayout, 'tableName' => $tableName  ])
    @elseif(!$filter->hasCustomPosition())
        <x-livewire-tables::tools.filter-label :filter="$filter" :theme="$theme" :filterLayout="$filterLayout" :tableName="$tableName" />
    @endif
    <div @class([
            "rounded-md shadow-sm" => $theme === 'tailwind',
            "mb-3 mb-md-0 input-group" => $theme === 'bootstrap-4',
            "mb-3 mb-md-0 input-group" => $theme === 'bootstrap-5',
        ])
    >
        <input
            wire:model.blur="filterComponents.{{ $filter->getKey() }}"
            wire:key="{{ $tableName }}-filter-{{ $filter->getKey() }}@if($filter->hasCustomPosition())-{{ $filter->getCustomPosition() }}@endif"
            id="{{ $tableName }}-filter-{{ $filter->getKey() }}@if($filter->hasCustomPosition())-{{ $filter->getCustomPosition() }}@endif"
            type="number"
            @if($filter->hasConfig('min')) min="{{ $filter->getConfig('min') }}" @endif
            @if($filter->hasConfig('max')) max="{{ $filter->getConfig('max') }}" @endif
            @class([
                "block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600" => $theme === 'tailwind',
                "form-control" => $theme === 'bootstrap-4',
                "form-control" => $theme === 'bootstrap-5',
            ])
        />
    </div>
</div>
