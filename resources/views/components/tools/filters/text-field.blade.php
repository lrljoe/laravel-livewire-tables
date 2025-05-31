<div>
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout :$tableName :$isTailwind :$isTailwind4 :$isBootstrap4 :$isBootstrap5 :$isBootstrap />

    <div @class([
        'rounded-md shadow-sm' => $isTailwind,
        'rounded-md shadow-sm' => $isTailwind4,
        'mb-3 mb-md-0 input-group' => $isBootstrap,
    ])>
        <input {!! $filter->getWireMethod('appliedFilters.'.$filter->getKey()) !!} {{ 
                $filterInputAttributes->merge()
                ->class([
                    // Tailwind 3
                    'block w-full rounded-md shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50' => $isTailwind && ($filterInputAttributes['default-styling'] ?? true),
                    'border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600' => $isTailwind && ($filterInputAttributes['default-colors'] ?? true),

                    // Tailwind 4
                    'block w-full rounded-md shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50' => $isTailwind4 && ($filterInputAttributes['default-styling'] ?? true),
                    'border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600' => $isTailwind4 && ($filterInputAttributes['default-colors'] ?? true),

                    // Bootstrap
                    'form-control' => $isBootstrap,
                ])
                ->except(['default-styling','default-colors']) 
            }} />
    </div>
</div>
