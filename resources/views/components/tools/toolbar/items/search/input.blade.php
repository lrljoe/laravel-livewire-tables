@aware(['isTailwind', 'isTailwind4', 'isBootstrap', 'searchViewAttributes'])
@props(['searchOptions' => '', 'searchPlaceholder' => null, 'searchFieldAttributes' => [], 'hasSearch' => false, 'icon' => []])
<input
    wire:model{{ $searchOptions }}="search"
    placeholder="{{ $searchPlaceholder }}"
    type="text"
    {{ 
        $attributes->merge($searchFieldAttributes)
        ->class(($isTailwind  || $isTailwind4) ?
            [
                'h-min rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 rounded-none rounded-l-md focus:ring-0 focus:border-gray-300' => $hasSearch && (($searchFieldAttributes['default'] ?? true) || ($searchFieldAttributes['default-styling'] ?? true)),
                'h-min rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 rounded-md focus:ring focus:ring-opacity-50' => !$hasSearch  && (($searchFieldAttributes['default'] ?? true) || ($searchFieldAttributes['default-styling'] ?? true)),
                'border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:border-gray-300' =>$hasSearch  && (($searchFieldAttributes['default'] ?? true) || ($searchFieldAttributes['default-colors'] ?? true)),
                'border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:border-indigo-300 focus:ring-indigo-200' =>!$hasSearch  && (($searchFieldAttributes['default'] ?? true) || ($searchFieldAttributes['default-colors'] ?? true)),
                'block w-full' => !$icon['hasSearchIcon'],
                'pl-8 pr-4' => $icon['hasSearchIcon'],
            ] :
            [
                'form-control' => $searchFieldAttributes['default'] ?? true,
                'block w-full' => !$icon['hasSearchIcon'],
                'pl-8 pr-4' => $icon['hasSearchIcon'],
            ],
        )
        ->except(['default','default-styling','default-colors']) 
    }}

/>