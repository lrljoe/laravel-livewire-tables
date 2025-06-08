@aware(['isTailwind', 'isTailwind4', 'isBootstrap', 'tableName', 'localisationPath'])

@php($actions = $this->getActions())

@if($showActionsInToolbar && ($showActionsAsDropdown || count($actions) >= 5))

    <x-livewire-tables::dropdown.wrapper>
        {{-- The Button Used To Toggle The Menu --}}
        <x-livewire-tables::dropdown.button id="{{ $tableName }}-actionsDropdownButton" aria-controls="{{ $tableName }}-actionsDropdownBody" {{ $attributes->merge($this->getActionsButtonAttributes) }}>
            {{ __($localisationPath.'Actions') }}

            @if($isTailwind || $isTailwind4)
                <x-heroicon-m-chevron-down class="-mr-1 ml-2 h-5 w-5" />
            @endif
        </x-livewire-tables::dropdown.button>

        {{-- The Body of The Menu --}}
        <x-livewire-tables::dropdown.body id="{{ $tableName }}-actionsDropdownBody" aria-labelledby="{{ $tableName }}-actionsDropdownButton" {{ $attributes->merge($this->getActionsMenuAttributes) }}>
            @foreach($actions as $action)
                {{ $action->setInMenu(true)->render() }}
            @endforeach
        </x-livewire-tables::dropdown.body>
    </x-livewire-tables::dropdown.wrapper>

@else
        <div {{ $attributes
                    ->merge($actionWrapperAttributes)
                    ->class([
                        'h-full flex flex-cols space-x-2' => $isTailwind && ($actionWrapperAttributes['default-styling'] ?? true),
                        '' => $isTailwind && ($actionWrapperAttributes['default-colors'] ?? true),
                        'tw4ph flex flex-cols py-2 space-x-2' => $isTailwind4 && ($actionWrapperAttributes['default-styling'] ?? true),
                        'tw4ph ' => $isTailwind4 && ($actionWrapperAttributes['default-colors'] ?? true),

                        'd-flex flex-cols py-2 space-x-2' => $isBootstrap && ($actionWrapperAttributes['default-styling'] ?? true),
                        '' => $isBootstrap && ($actionWrapperAttributes['default-colors'] ?? true),
                        
                        // All
                        'justify-start' => $actionsPosition === 'left',
                        'justify-center' => $actionsPosition === 'center',
                        'justify-end' => $actionsPosition === 'right',
                        'pl-2' => $showActionsInToolbar && $actionsPosition === 'left',
                        'pr-2' => $showActionsInToolbar && $actionsPosition === 'right',
                    ])
                    ->except(['default','default-styling','default-colors'])
                }} >

                    @foreach($actions as $action)
                        {{ $action->render() }}
                    @endforeach

        </div>
@endif