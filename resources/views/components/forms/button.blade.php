@aware(['isTailwind','isTailwind4','isBootstrap','isBootstrap4','isBootstrap5'])
{{-- This is used for Buttons --}}
<button
    {{ 
        $attributes->merge()
        ->class([
            'btn dropdown-toggle d-block d-md-inline' => $isBootstrap && ($attributes['default-styling'] ?? true),
            'border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $isTailwind && ($attributes['default-colors'] ?? true),
            'h-full content-center items-center inline-flex content-center justify-center w-full rounded-md border shadow-sm px-4 py-2 text-sm font-medium focus:ring focus:ring-opacity-50' => $isTailwind && ($attributes['default-styling'] ?? true),
            'tw4ph border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $isTailwind4 && ($attributes['default-colors'] ?? true),
            'tw4ph inline-flex justify-center w-full rounded-md border shadow-sm px-4 py-2 text-sm font-medium focus:ring focus:ring-opacity-50' => $isTailwind4 && ($attributes['default-styling'] ?? true),
        ])
        ->except(['default','default-styling','default-colors']) 
    }}
>
   {{ $slot }}
</button>