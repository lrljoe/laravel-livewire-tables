@aware(['dataTableFingerprint','primaryKey', 'isTailwind', 'isTailwind4','isBootstrap', 'isBootstrap4', 'isBootstrap5'])
@props(['checkboxAttributes'])
<input type='checkbox' x-cloak
    {{
        $attributes->merge($checkboxAttributes)
            ->class([
            // Tailwind 3
            'border-gray-300 text-indigo-600 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600' => ($isTailwind || $isTailwind4) && ($checkboxAttributes['default-colors'] ?? ($checkboxAttributes['default'] ?? true)),
            'rounded shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50' => $isTailwind && ($checkboxAttributes['default-styling'] ?? ($checkboxAttributes['default'] ?? true)),

            // Tailwind 4
            'rounded-md shadow-sm transition transition-duration-150 ease-in-out focus:ring focus:ring-opacity-50/100' => $isTailwind4 && ($checkboxAttributes['default-styling'] ?? ($checkboxAttributes['default'] ?? true)),

            // Bootstrap
            'form-check-input' => ($isBootstrap5) && ($checkboxAttributes['default'] ?? true),
        ])->except(['default','default-styling','default-colors'])
    }}
/> 