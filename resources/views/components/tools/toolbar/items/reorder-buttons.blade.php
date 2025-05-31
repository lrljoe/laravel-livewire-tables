@aware(['tableName','isTailwind', 'isTailwind4', 'isBootstrap','isBootstrap4','isBootstrap5','localisationPath'])
@php($allReorderButtonAttributes = $this->getAllReorderButtonAttributes())
@php($reorderButtonStartAttributes = $allReorderButtonAttributes['start'])
@php($reorderButtonSaveAttributes = $allReorderButtonAttributes['save'])
@php($reorderButtonCancelAttributes = $allReorderButtonAttributes['cancel'])

<div x-data x-cloak x-show="reorderStatus"
    @class([
        'inline-flex space-x-2' => $isTailwind,
        'tw4ph inline-flex space-x-2' => $isTailwind4,

        
        'mr-0 mr-md-2 mb-3 mb-md-0' => $isBootstrap4,
        'me-0 me-md-2 mb-3 mb-md-0' => $isBootstrap5,
    ])
>
    <div x-cloak x-show="!currentlyReorderingStatus" >
        <button {{ $attributes->merge($reorderButtonStartAttributes)->class(
                [
                    'inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border shadow-sm text-sm font-medium rounded-md focus:ring focus:ring-opacity-50 transition ease-in-out duration-150' => $isTailwind && ($reorderButtonStartAttributes['default-styling'] ?? true),
                    'border-gray-300 text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring-indigo-200 active:bg-gray-50 active:text-gray-800 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $isTailwind && ($reorderButtonStartAttributes['default-colors'] ?? true),
                    'tw4ph inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border shadow-sm text-sm font-medium rounded-md focus:ring focus:ring-opacity-50 transition ease-in-out duration-150' => $isTailwind4 && ($reorderButtonStartAttributes['default-styling'] ?? true),
                    'tw4ph border-gray-300 text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring-indigo-200 active:bg-gray-50 active:text-gray-800 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $isTailwind4 && ($reorderButtonStartAttributes['default-colors'] ?? true),

                    'btn btn-default d-block d-md-inline' => $isBootstrap && ($reorderButtonStartAttributes['default'] ?? true),
                ]
            ) }}
        >
            <span>
                {{ __($localisationPath.'Reorder') }}
            </span>
        </button>
    </div>
    <div x-cloak x-show="currentlyReorderingStatus" >
        <button 
            {{ $attributes->merge($reorderButtonCancelAttributes)->class(
                [
                    'inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border shadow-sm text-sm font-medium rounded-md focus:ring focus:ring-opacity-50 transition ease-in-out duration-150' => $isTailwind && ($reorderButtonCancelAttributes['default-styling'] ?? true),
                    'border-gray-300 text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring-indigo-200 active:bg-gray-50 active:text-gray-800 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $isTailwind && ($reorderButtonCancelAttributes['default-colors'] ?? true),
                    'tw4ph inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border shadow-sm text-sm font-medium rounded-md focus:ring focus:ring-opacity-50 transition ease-in-out duration-150' => $isTailwind4 && ($reorderButtonCancelAttributes['default-styling'] ?? true),
                    'tw4ph border-gray-300 text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring-indigo-200 active:bg-gray-50 active:text-gray-800 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $isTailwind4 && ($reorderButtonCancelAttributes['default-colors'] ?? true),

                    'btn btn-default d-block d-md-inline' => $isBootstrap && ($reorderButtonCancelAttributes['default'] ?? true),
                ]
            ) }}
        >
            <span>
                {{ __($localisationPath.'Cancel') }}
            </span>
        </button>

    </div>


    <div :class="{ 'inline d-inline' : currentlyReorderingStatus }" x-cloak x-show="currentlyReorderingStatus" >
        <button
        {{ $attributes->merge($reorderButtonSaveAttributes)->class(
            [
                'inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border shadow-sm text-sm font-medium rounded-md focus:ring focus:ring-opacity-50 transition ease-in-out duration-150' => $isTailwind && ($reorderButtonSaveAttributes['default-styling'] ?? true),
                'border-gray-300 text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring-indigo-200 active:bg-gray-50 active:text-gray-800 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $isTailwind && ($reorderButtonSaveAttributes['default-colors'] ?? true),
                'tw4ph inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border shadow-sm text-sm font-medium rounded-md focus:ring focus:ring-opacity-50 transition ease-in-out duration-150' => $isTailwind4 && ($reorderButtonSaveAttributes['default-styling'] ?? true),
                'tw4ph border-gray-300 text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring-indigo-200 active:bg-gray-50 active:text-gray-800 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $isTailwind4 && ($reorderButtonSaveAttributes['default-colors'] ?? true),

                'btn btn-default d-block d-md-inline' => $isBootstrap && ($reorderButtonSaveAttributes['default'] ?? true),

            ]
        ) }}
        >
            <span>
                {{ __($localisationPath.'save') }}
            </span>
        </button>
    </div>


</div>
