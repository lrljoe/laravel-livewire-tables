@aware(['isTailwind','isTailwind4','isBootstrap','isBootstrap4','isBootstrap5', 'localisationPath'])
@php($resetAllButtonAttributes = $this->getFilterPillsResetAllButtonAttributes())

@if ($isTailwind || $isTailwind4)
    <button
        x-on:click.prevent="resetAllFilters"
        @class($isTailwind ? [
            'focus:outline-none active:outline-none',
        ] : [
            'focus:outline-none active:outline-none',
        ]
    )>
        <span
            {{
                $attributes->merge($resetAllButtonAttributes)
                ->class($isTailwind ? [
                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium' => ($resetAllButtonAttributes['default-styling'] ?? true),
                    'bg-gray-100 text-gray-800 dark:bg-gray-200 dark:text-gray-900' => ($resetAllButtonAttributes['default-colors'] ?? true),
                ] : [])
                ->class($isTailwind4 ? [
                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium' => ($resetAllButtonAttributes['default-styling'] ?? true),
                    'bg-gray-100 text-gray-800 dark:bg-gray-200 dark:text-gray-900' => ($resetAllButtonAttributes['default-colors'] ?? true),
                ] : [])
                ->except(['default-styling', 'default-colors'])
            }}
        >
            {{ __($localisationPath.'Clear') }}
        </span>
    </button>
@else
    <a
        href="#"
        x-on:click.prevent="resetAllFilters"
        {{
            $attributes->merge($resetAllButtonAttributes)
            ->class($isBootstrap4 ? [
                'badge badge-pill badge-light' => ($resetAllButtonAttributes['default-styling'] ?? true),
            ] : [])
            ->class($isBootstrap5 ? [
                'badge rounded-pill bg-light text-dark text-decoration-none' => ($resetAllButtonAttributes['default-styling'] ?? true),
            ] : [])
            ->except(['default-styling', 'default-colors'])
        }}
    >
        {{ __($localisationPath.'Clear') }}
    </a>
@endif
