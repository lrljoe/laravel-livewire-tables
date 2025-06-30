@aware([ 'dataTableFingerprint','isTailwind','isTailwind4','isBootstrap','isBootstrap4','isBootstrap5', 'localisationPath'])
{{-- This is used for the Dropdown Menu Body --}}
<div :aria-expanded="open"
    {{ 
        $attributes
        ->merge()
        ->class([
            'bg-white dark:bg-gray-700 dark:text-white ring-black divide-gray-100 dark:divide-gray-400' => $isTailwind && ($attributes['default-colors'] ?? true),
            'mt-1 py-1 w-full  rounded-md shadow-lg ring-1 ring-opacity-5 divide-y focus:outline-none z-50' => $isTailwind && ($attributes['default-styling'] ?? true),
            'tw4ph bg-white dark:bg-gray-700 dark:text-white ring-black divide-gray-100 dark:divide-gray-400' => $isTailwind4 && ($attributes['default-colors'] ?? true),
            'tw4ph mt-1 py-1 w-full  rounded-md shadow-lg ring-1 ring-opacity-5 divide-y focus:outline-none z-50' => $isTailwind4 && ($attributes['default-styling'] ?? true),
            'dropdown-menu dropdown-menu-right w-100' => $isBootstrap4 && ($attributes['default-styling'] ?? true),
            'dropdown-menu dropdown-menu-end w-100' => $isBootstrap5 && ($attributes['default-styling'] ?? true),
        ])
        ->except(['default','default-styling','default-colors']) 
    }}
>
    {{ $slot }}
</div>