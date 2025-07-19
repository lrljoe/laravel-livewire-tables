@aware(['dataTableFingerprint','primaryKey', 'isTailwind', 'isTailwind4','isBootstrap', 'isBootstrap4', 'isBootstrap5'])
@props(['checkboxAttributes'])
<input x-cloak
    {{
        $attributes->merge($checkboxAttributes)
            ->class([
            // Tailwind 3
            'border-gray-300 text-indigo-600 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600' => $isTailwind && ($checkboxAttributes['default-colors'] ?? ($checkboxAttributes['default'] ?? true)),
            'rounded shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50' => $isTailwind && ($checkboxAttributes['default-styling'] ?? ($checkboxAttributes['default'] ?? true)),

            // Tailwind 4
            'tw4ph border-gray-300 text-indigo-600 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600' => $isTailwind4 && ($checkboxAttributes['default-colors'] ?? ($checkboxAttributes['default'] ?? true)),
            'tw4ph rounded shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50' => $isTailwind4 && ($checkboxAttributes['default-styling'] ?? ($checkboxAttributes['default'] ?? true)),

            // Bootstrap
            'form-check-input' => ($isBootstrap5) && ($checkboxAttributes['default'] ?? true),
        ])->except(['default','default-styling','default-colors'])
    }}
/> 