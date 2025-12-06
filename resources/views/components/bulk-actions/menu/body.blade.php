@aware([ 'dataTableFingerprint','isTailwind','isTailwind4','isBootstrap','isBootstrap4','isBootstrap5', 'localisationPath'])
{{-- This is used for the Bulk Actions Dropdown Menu Body --}}
<div :aria-expanded="open"
    {{ 
        $attributes
        ->merge()
        ->class($isTailwind ? [
            'bg-white dark:bg-gray-700 dark:text-white ring-black divide-gray-100 dark:divide-gray-400' => ($attributes['default-colors'] ?? true),
            'mt-1 py-1 w-full md:w-48 rounded-md shadow-lg ring-1 ring-opacity-5 divide-y focus:outline-none z-50' => ($attributes['default-styling'] ?? true),
        ]: [])
        ->class($isTailwind4 ? [
            'bg-white dark:bg-gray-700 dark:text-white ring-black divide-gray-100 dark:divide-gray-400' => ($attributes['default-colors'] ?? true),
            'mt-1 py-1 w-full md:w-48 rounded-md shadow-lg ring-1 ring-opacity-5 divide-y focus:outline-none z-50' => ($attributes['default-styling'] ?? true),

        ]: [])
        ->class($isBootstrap4 ? [
            'dropdown-menu dropdown-menu-right w-100' => ($attributes['default-styling'] ?? true),
        ]: [])
        ->class($isBootstrap5 ? [
            'dropdown-menu dropdown-menu-end w-100' => ($attributes['default-styling'] ?? true),
        ]: [])
        ->except(['default','default-styling','default-colors']) 
    }}
>
    {{ $slot }}
</div>
