@aware(['dataTableFingerprint', 'localisationPath', 'filterLayout', 'isTailwind', 'isTailwind4', 'isBootstrap', 'isBootstrap4', 'isBootstrap5', 'filterMenuResetButtonAttributes'])
@php
    $defaultValue = ($filter->hasFilterDefaultValue() ? $filter->getFilterDefaultValue() : null)
@endphp
 <x-livewire-tables::tools.filters.wrapper-string :$filter :$filterInputAttributes :$filterLabelAttributes :$customLabelAttributes>
    <div @class([
        'basis-full w-full flex flex-row items-center rounded-md shadow-sm' => $isTailwind,
        'tw4ph rounded-md shadow-sm' => $isTailwind4,
        'mb-3 mb-md-0 input-group' => $isBootstrap,
    ])>
        <select {!! $filter->getWireMethod('appliedFilters.'.$filter->getKey()) !!} {{ $filterInputAttributes->merge()
                ->class([
                    // Tailwind 3
                    'block w-full transition duration-150 ease-in-out rounded-md shadow-sm focus:ring focus:ring-opacity-50' => $isTailwind && ($filterInputAttributes['default-styling'] ?? true),
                    'border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600' => $isTailwind && ($filterInputAttributes['default-colors'] ?? true),

                    // Tailwind 4
                    'tw4ph block w-full transition duration-150 ease-in-out rounded-md shadow-sm focus:ring focus:ring-opacity-50' => $isTailwind4 && ($filterInputAttributes['default-styling'] ?? true),
                    'tw4ph border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600' => $isTailwind4 && ($filterInputAttributes['default-colors'] ?? true),

                    // Bootstrap 4
                    'form-control' => $isBootstrap4 && ($filterInputAttributes['default-styling'] ?? true),

                    // Bootstrap 5
                    'form-select' => $isBootstrap5 && ($filterInputAttributes['default-styling'] ?? true),
                ])
                ->except(['default-styling','default-colors']) 
            }}
        >
            @foreach($filter->getOptions() as $key => $value)
                @if (is_iterable($value))
                    <optgroup label="{{ $key }}">
                        @foreach ($value as $optionKey => $optionValue)
                            <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                        @endforeach
                    </optgroup>
                @else
                    <option value="{{ $key }}">{{ $value }}</option>
                @endif
            @endforeach
        </select>
    </div>
 </x-livewire-tables::tools.filters.wrapper-string>

