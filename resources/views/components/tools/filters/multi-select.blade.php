<div>
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout :$tableName :$isTailwind :$isTailwind4 :$isBootstrap4 :$isBootstrap5 :$isBootstrap />

    @if ($isTailwind || $isTailwind4)
    <div @class([
        'rounded-md shadow-sm' => $isTailwind,
        'rounded-md shadow-sm' => $isTailwind4,
    ])>
    @endif
        <div @class(['form-check' => $isBootstrap])>
            <input id="{{ $tableName }}-filter-{{ $filter->getKey() }}-select-all{{ $filter->hasCustomPosition() ? '-'.$filter->getCustomPosition() : null }}" wire:input="selectAllFilterOptions('{{ $filter->getKey() }}')" {{ 
                    $filterInputAttributes->merge([
                        'type' => 'checkbox'
                    ])
                    ->class([
                        // Tailwind 3
                        'rounded shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-wait' => $isTailwind && ($filterInputAttributes['default-styling'] ?? true),
                        'text-indigo-600 border-gray-300 focus:border-indigo-300  focus:ring-indigo-200  dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600 ' => $isTailwind && ($filterInputAttributes['default-colors'] ?? true),

                        // Tailwind 4
                        'rounded shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-wait' => $isTailwind4 && ($filterInputAttributes['default-styling'] ?? true),
                        'text-indigo-600 border-gray-300 focus:border-indigo-300  focus:ring-indigo-200  dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600 ' => $isTailwind4 && ($filterInputAttributes['default-colors'] ?? true),

                        // Bootstrap
                        'form-check-input' => $isBootstrap && ($filterInputAttributes['default-styling'] ?? true),
                    ])
                    ->except(['id','wire:key','value','default-styling','default-colors']) 
                }}>
            <label for="{{ $tableName }}-filter-{{ $filter->getKey() }}-select-all{{ $filter->hasCustomPosition() ? '-'.$filter->getCustomPosition() : null }}" @class([
                'dark:text-white' => $isTailwind,
                'dark:text-white' => $isTailwind4,
                'form-check-label' => $isBootstrap,
                ])>
                @if ($filter->getFirstOption() !== '')
                    {{ $filter->getFirstOption() }}
                @else
                    {{ __($localisationPath.'All') }}
                @endif
            </label>
        </div>

        @foreach($filter->getOptions() as $key => $value)
            <div @class([
                'form-check' => $isBootstrap,
                ]) wire:key="{{ $tableName }}-filter-{{ $filter->getKey() }}-multiselect-{{ $key }}{{ $filter->hasCustomPosition() ? '-'.$filter->getCustomPosition() : null }}">
                <input {!! $filter->getWireMethod('appliedFilters.'.$filter->getKey()) !!} 
                id="{{ $tableName }}-filter-{{ $filter->getKey() }}-{{ $loop->index }}{{ $filter->hasCustomPosition() ? '-'.$filter->getCustomPosition() : null }}" 
                
                wire:key="{{ $tableName }}-filter-{{ $filter->getKey() }}-{{ $loop->index }}{{ $filter->hasCustomPosition() ? '-'.$filter->getCustomPosition() : null }}" value="{{ $key }}" {{ 
                    $filterInputAttributes->merge([
                        'type' => 'checkbox'
                    ])
                    ->class([
                        // Tailwind 3
                        'rounded shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-wait' => $isTailwind && ($filterInputAttributes['default-styling'] ?? true),
                        'text-indigo-600 border-gray-300 focus:border-indigo-300  focus:ring-indigo-200  dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600 ' => $isTailwind && ($filterInputAttributes['default-colors'] ?? true),

                        // Tailwind 4
                        'rounded shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-wait' => $isTailwind4 && ($filterInputAttributes['default-styling'] ?? true),
                        'text-indigo-600 border-gray-300 focus:border-indigo-300  focus:ring-indigo-200  dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600 ' => $isTailwind4 && ($filterInputAttributes['default-colors'] ?? true),

                        // Bootstrap
                        'form-check-input' => $isBootstrap && ($filterInputAttributes['default-styling'] ?? true),
                    ])
                    ->except(['id','wire:key','value','default-styling','default-colors']) 
                }}>
                <label for="{{ $tableName }}-filter-{{ $filter->getKey() }}-{{ $loop->index }}{{ $filter->hasCustomPosition() ? '-'.$filter->getCustomPosition() : null }}" @class([
                    'dark:text-white' => $isTailwind,
                    'dark:text-white' => $isTailwind4,
                    'form-check-label' => $isBootstrap,
                ])>{{ $value }}</label>
            </div>
        @endforeach
    @if ($isTailwind || $isTailwind4)
    </div>
    @endif
</div>
