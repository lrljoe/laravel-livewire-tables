@aware([ 'dataTableFingerprint','isTailwind','isTailwind4','isBootstrap','isBootstrap4','isBootstrap5', 'localisationPath'])

<div @class([
        'ml-0 ml-md-2' => $isBootstrap4,
        'ms-0 ms-md-2' => $isBootstrap5,
    ])
>
    <select wire:model.live="perPage" id="{{ $dataTableFingerprint }}-perPage"
        {{ 
            $attributes->merge($perPageFieldAttributes)
            ->class([
                'block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:ring focus:ring-opacity-50' => $isTailwind && $perPageFieldAttributes['default-styling'],
                'border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600' => $isTailwind && $perPageFieldAttributes['default-colors'],
                'tw4ph block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:ring focus:ring-opacity-50' => $isTailwind4 && $perPageFieldAttributes['default-styling'],
                'tw4ph border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600' => $isTailwind4 && $perPageFieldAttributes['default-colors'],
                'form-control' => $isBootstrap4 && $perPageFieldAttributes['default-styling'],
                'form-select' => $isBootstrap5 && $perPageFieldAttributes['default-styling'],
            ])
            ->except(['default','default-styling','default-colors']) 
        }}
    >
        @foreach ($this->getPerPageAccepted() as $item)
            <option
                value="{{ $item }}"
                wire:key="{{ $dataTableFingerprint }}-per-page-{{ $item }}"
            >
                {{ $item === -1 ? __($localisationPath.'All') : $item }}
            </option>
        @endforeach
    </select>
</div>
