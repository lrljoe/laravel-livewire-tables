@aware(['isTailwind','isTailwind4','isBootstrap','isBootstrap4','isBootstrap5', 'localisationPath'])
@php($resetAllButtonAttributes = $this->getFilterPillsResetAllButtonAttributes())

@if ($isTailwind || $isTailwind4)
    <button
        x-on:click.prevent="resetAllFilters"
        @class([
            'focus:outline-none active:outline-none'
        ])>
        <span
            {{
                $attributes->merge($resetAllButtonAttributes)
                ->class([
                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium' => ($resetAllButtonAttributes['default-styling'] ?? true),
                    'bg-gray-100 text-gray-800 dark:bg-gray-200 dark:text-gray-900' => ($resetAllButtonAttributes['default-colors'] ?? true),
                ])
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
            ->class([
                'badge badge-pill badge-light' => $isBootstrap4 && ($resetAllButtonAttributes['default-styling'] ?? true),
                'badge rounded-pill bg-light text-dark text-decoration-none' => $isBootstrap5 && ($resetAllButtonAttributes['default-styling'] ?? true),
            ])
            ->except(['default-styling', 'default-colors'])
        }}
    >
        {{ __($localisationPath.'Clear') }}
    </a>
@endif
