@aware(['isTailwind', 'isBootstrap', 'searchViewAttributes'])
<input
    wire:model{{ $searchViewAttributes['searchOptions'] }}="search"
    placeholder="{{ $searchViewAttributes['searchPlaceholder'] }}"
    type="text"
    {{ 
        $attributes->merge($searchViewAttributes['searchFieldAttributes'])
        ->class($isTailwind ?
            [
                'rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 rounded-none rounded-l-md focus:ring-0 focus:border-gray-300' => $searchViewAttributes['hasSearch'] && (($searchViewAttributes['searchFieldAttributes']['default'] ?? true) || ($searchViewAttributes['searchFieldAttributes']['default-styling'] ?? true)),
                'rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 rounded-md focus:ring focus:ring-opacity-50' => !$searchViewAttributes['hasSearch']  && (($searchViewAttributes['searchFieldAttributes']['default'] ?? true) || ($searchViewAttributes['searchFieldAttributes']['default-styling'] ?? true)),
                'border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:border-gray-300' =>$searchViewAttributes['hasSearch']  && (($searchViewAttributes['searchFieldAttributes']['default'] ?? true) || ($searchViewAttributes['searchFieldAttributes']['default-colors'] ?? true)),
                'border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:border-indigo-300 focus:ring-indigo-200' =>!$searchViewAttributes['hasSearch']  && (($searchViewAttributes['searchFieldAttributes']['default'] ?? true) || ($searchViewAttributes['searchFieldAttributes']['default-colors'] ?? true)),
                'block w-full' => !$searchViewAttributes['icon']['hasSearchIcon'],
                'pl-8 pr-4' => $searchViewAttributes['icon']['hasSearchIcon'],
            ] :
            [
                'form-control' => $searchViewAttributes['searchFieldAttributes']['default'] ?? true,
                'block w-full' => !$searchViewAttributes['icon']['hasSearchIcon'],
                'pl-8 pr-4' => $searchViewAttributes['icon']['hasSearchIcon'],
            ],
        )
        ->except(['default','default-styling','default-colors']) 
    }}

/>