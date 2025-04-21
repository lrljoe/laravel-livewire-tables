@aware(['tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5','localisationPath'])
@php($reorderButtonStartAttributes = $this->getReorderButtonStartAttributes())
@php($reorderButtonSaveAttributes = $this->getReorderButtonSaveAttributes())
@php($reorderButtonCancelAttributes = $this->getReorderButtonCancelAttributes())

<div x-data x-cloak x-show="reorderStatus"
    @class([
        'mr-0 mr-md-2 mb-3 mb-md-0' => $isBootstrap4,
        'me-0 me-md-2 mb-3 mb-md-0' => $isBootstrap5,
        'inline-flex space-x-2' => $isTailwind,
    ])
>
    <div x-cloak x-show="!currentlyReorderingStatus" >
        <button {{ $attributes->merge($reorderButtonStartAttributes)->class(
                [
                    'btn btn-default d-block d-md-inline' => $isBootstrap && ($reorderButtonStartAttributes['default'] ?? true),
                    'inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border shadow-sm text-sm font-medium rounded-md focus:ring focus:ring-opacity-50 transition ease-in-out duration-150' => $isTailwind && ($reorderButtonStartAttributes['default-styling'] ?? true),
                    'border-gray-300 text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring-indigo-200 active:bg-gray-50 active:text-gray-800 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $isTailwind && ($reorderButtonStartAttributes['default-colors'] ?? true),
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
                    'btn btn-default d-block d-md-inline' => $isBootstrap && ($reorderButtonCancelAttributes['default'] ?? true),
                    'inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border shadow-sm text-sm font-medium rounded-md focus:ring focus:ring-opacity-50 transition ease-in-out duration-150' => $isTailwind && ($reorderButtonCancelAttributes['default-styling'] ?? true),
                    'border-gray-300 text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring-indigo-200 active:bg-gray-50 active:text-gray-800 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $isTailwind && ($reorderButtonCancelAttributes['default-colors'] ?? true),
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
                'btn btn-default d-block d-md-inline' => $isBootstrap && ($reorderButtonSaveAttributes['default'] ?? true),
                'inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border shadow-sm text-sm font-medium rounded-md focus:ring focus:ring-opacity-50 transition ease-in-out duration-150' => $isTailwind && ($reorderButtonSaveAttributes['default-styling'] ?? true),
                'border-gray-300 text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring-indigo-200 active:bg-gray-50 active:text-gray-800 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $isTailwind && ($reorderButtonSaveAttributes['default-colors'] ?? true),
            ]
        ) }}
        >
            <span>
                {{ __($localisationPath.'save') }}
            </span>
        </button>
    </div>


</div>
