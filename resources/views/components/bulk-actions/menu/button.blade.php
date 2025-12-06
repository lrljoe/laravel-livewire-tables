@aware(['isTailwind','isTailwind4', 'localisationPath'])
{{-- This is used for the Bulk Actions Dropdown Menu Button --}}
<x-livewire-tables::forms.button {{ $attributes }}>
    {{ __($localisationPath.'Bulk Actions') }}

    @if($isTailwind || $isTailwind4)
        <x-heroicon-m-chevron-down class="-mr-1 ml-2 h-5 w-5" />
    @endif
</x-livewire-tables::forms.button>

        