@aware(['localisationPath'])

@if($isToggleable && $toggleMethod !== '')
<button wire:click="{{ $toggleMethod }}('{{ $rowPrimaryKey }}')" @if($hasConfirmMessage) wire:confirm="{{ $confirmMessage }}" @endif>
@endif
    @if ($type === 'icons')
        @if ($isSuccessful)
            <x-heroicon-o-check-circle
                @class(
                    [
                        'inline-block h-5 w-5 text-green-500' => $isTailwind,
                        'tw4ph inline-block h-5 w-5 text-green-500' => $isTailwind4,
                        'd-inline-block text-success laravel-livewire-tables-btn-small' => $isBootstrap
                    ]
                )
            />
        @else
            <x-heroicon-o-x-circle @class(
                    [
                        'inline-block h-5 w-5 text-red-500' => $isTailwind,
                        'tw4ph inline-block h-5 w-5 text-red-500' => $isTailwind4,
                        'd-inline-block text-danger laravel-livewire-tables-btn-small' => $isBootstrap
                    ]
                )
            />
        @endif
    @elseif ($type === 'yes-no')
        @if ($isSuccessful)
            <span>{{ __($localisationPath.'Yes') }}</span>
        @else
            <span>{{ __($localisationPath.'No') }}</span>
        @endif
    @endif
@if($isToggleable && $toggleMethod !== '')
</button>
@endif
