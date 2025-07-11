@aware(['dataTableFingerprint', 'localisationPath', 'filterLayout', 'isTailwind', 'isTailwind4', 'isBootstrap', 'isBootstrap4', 'isBootstrap5', 'filterMenuResetButtonAttributes'])
@props(['filter', 'filterLabelAttributes', 'filterInputAttributes', 'customLabelAttributes'])
@php
    $defaultValue = ($filter->hasFilterDefaultValue() ? $filter->getFilterDefaultValue() : null)
@endphp

@if($isTailwind)

<x-livewire-tables::tools.filters.wrapper x-data="newBooleanFilter($wire, '{{ $filter->getKey() }}', '{{ $dataTableFingerprint }}', '{{ $defaultValue }}')">
    <x-slot:label>
        <x-livewire-tables::tools.filter-label :$filter :$filterLayout :$filterLabelAttributes :$customLabelAttributes />
    </x-slot:label>
    <x-slot:clearButton>
        <template x-if="($wire.get('appliedFilters.{{ $filter->getKey() }}') ?? null) !== null">
            <div class="w-1/12 inline-flex items-end justify-end ">
                <button @click="toggleStatusWithReset" {{ $this->getFilterMenuResetButtonAttributesBag->merge(['type' => 'button'])->class([
                            'w-min rounded-full focus:outline-none' => $isTailwind && ($this->getFilterMenuResetButtonAttributes['default-styling'] ?? true),    
                            'text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:bg-indigo-500 focus:text-white' => $isTailwind && ($this->getFilterMenuResetButtonAttributes['default-colors'] ?? true),    
                    ])->except(['default-colors','default-styling']) 
                }}>
                    <span class="sr-only">{{ __($localisationPath.'Remove filter option') }}</span>
                    <x-heroicon-m-x-mark class="h-6 w-6" />
                </button>

            </div>
        </template>  
    </x-slot:clearButton>
    <div @class([
        'basis-full w-full flex flex-row items-center rounded-md shadow-sm' => $isTailwind,
        'tw4ph rounded-md shadow-sm' => $isTailwind4,
        'mb-3 mb-md-0 input-group' => $isBootstrap,
    ])>

            <button x-cloak {{ $filterInputAttributes->merge([
                        ":class" => "(value == 1 || value == true) ? '".$filterInputAttributes['activeColor']."' : '".$filterInputAttributes['inactiveColor']."'",
                    ])
                    ->class([
                        'relative inline-flex h-6 py-0.5  focus:outline-none rounded-full w-10' => $isTailwind && ($filterInputAttributes['default-styling'] ?? true),
                        'tw4ph relative inline-flex h-6 py-0.5 focus:outline-none rounded-full w-10' => $isTailwind4 && ($filterInputAttributes['default-styling'] ?? true),
                    ])
                    ->except(['default-styling','default-colors','activeColor','inactiveColor','blobColor'])
                }}>
                <span :class="(value == 1 || value == true) ? 'translate-x-[18px]' : 'translate-x-0.5'" 
                    @class([
                        $filterInputAttributes['blobColor'],
                        'w-5 h-5 duration-200 ease-in-out rounded-full shadow-md' => $isTailwind,
                        'tw4ph w-5 h-5 duration-200 ease-in-out rounded-full shadow-md' => $isTailwind4,
                    ])>
                </span>
            </button>

    </div>

 </x-livewire-tables::tools.filters.wrapper>

@else
<div class="form-check form-switch"
    x-data="newBooleanFilter($wire, '{{ $filter->getKey() }}', '{{ $dataTableFingerprint }}', '{{ $defaultValue }}')"
>
    <x-livewire-tables::tools.filter-label :$filter  :$filterLayout  :$filterLabelAttributes :$customLabelAttributes />
    <input id="thisId" type="checkbox" name="switch" class="form-check-input" role="switch" :checked="value" @click="toggleStatusWithUpdate" x-ref="switchButton"/>


    </div>
@endif
