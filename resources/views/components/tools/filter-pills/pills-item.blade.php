@aware(['dataTableFingerprint','isTailwind','isTailwind4','isBootstrap4','isBootstrap5'])
@props([
    'filterKey', 
    'filterPillData', 
    'shouldWatch' => ($filterPillData->shouldWatchForEvents() ?? 0),
    'filterPillsItemAttributes' => $filterPillData->getFilterPillsItemAttributes(),
    ])

<div x-data="filterPillsHandler(@js($filterPillData->getPillSetupData($filterKey,$shouldWatch)))" x-bind="trigger" 
        wire:key="{{ $dataTableFingerprint }}-filter-pill-{{ $filterKey }}" {{
        $attributes->merge($filterPillsItemAttributes)
        ->class($isTailwind ? [
            'inline-flex items-center px-2.5 py-0.5 rounded-full leading-4' => ($filterPillsItemAttributes['default-styling'] ?? true),
            'text-xs font-medium' => $isTailwind && ($filterPillsItemAttributes['default-text'] ?? ($filterPillsItemAttributes['default-styling'] ?? true)),
            'bg-indigo-100 text-indigo-800 dark:bg-indigo-200 dark:text-indigo-900' =>  ($filterPillsItemAttributes['default-colors'] ?? true),
        ]: [])
        ->class($isTailwind4 ? [
            'inline-flex items-center px-2.5 py-0.5 rounded-full leading-4' => ($filterPillsItemAttributes['default-styling'] ?? true),
            'text-xs font-medium' => $isTailwind4 && ($filterPillsItemAttributes['default-text'] ?? ($filterPillsItemAttributes['default-styling'] ?? true)),
            'bg-indigo-100 text-indigo-800 dark:bg-indigo-200 dark:text-indigo-900' => ($filterPillsItemAttributes['default-colors'] ?? true),
        ]: [])
        ->class($isBootstrap4 ? [
            'badge badge-pill badge-info d-inline-flex align-items-center' => ($filterPillsItemAttributes['default-styling'] ?? true),
        ]: [])
        ->class($isBootstrap5 ? [
            'badge rounded-pill bg-info d-inline-flex align-items-center' => ($filterPillsItemAttributes['default-styling'] ?? true),
        ]: [])
        ->except(['default', 'default-styling', 'default-colors'])
    }}
>
    <span x-text="localFilterTitle + ':&nbsp;'"></span>

    <span {{ $filterPillData->getFilterPillDisplayData() }}></span>


    <x-livewire-tables::tools.filter-pills.buttons.reset-filter :$filterKey :$filterPillData/>

</div>
