@aware(['dataTableFingerprint'])
@php
    $filterKey = $filter->getKey();
    $currentMin = $minRange = $filter->getConfig('minRange') ?? 0;
    $currentMax = $maxRange = $filter->getConfig('maxRange') ?? 100;
    $suffix = $filter->hasConfig('suffix') ? '--suffix:"'. $filter->getConfig('suffix') .'";' : '';
    $prefix = $filter->hasConfig('prefix') ? '--prefix:"'.$filter->getConfig('prefix').'";' : '';
@endphp
<div class="grid grid-cols-12" id="{{ $dataTableFingerprint }}-numberRange-{{ $filterKey }}" x-data="numberRangeFilter($wire,'{{ $filterKey }}', '{{ $dataTableFingerprint }}', '{{ $dataTableFingerprint }}-numberRange-{{ $filterKey }}-wrapper', @js($filter->getConfigs()), '{{ $dataTableFingerprint }}-numberRange-{{ $filterKey }}')" x-on:mousedown.away.throttle.2000ms="updateWireable" x-on:touchstart.away.throttle.2000ms="updateWireable" x-on:mouseleave.throttle.2000ms="updateWireable"> 
    <div class="col-start-1 col-span-11 min-h-7">
        <x-livewire-tables::tools.filter-label for="{{ $dataTableFingerprint.'-numberRange-'.$filterKey.'-min' }}" :$filter :$filterLayout :$filterLabelAttributes :$customLabelAttributes />
    </div>
    <div class="col-start-1 col-span-12">
        <div
            @class([
                'mt-4 h-22 pt-8 pb-4 grid gap-10' => $isTailwind,
                'tw4ph mt-4 h-22 pt-8 pb-4 grid gap-10' => $isTailwind4,
                'mt-4 h-22 w-100 pb-4 pt-2 grid gap-10' => $isBootstrap,
            ])
            wire:ignore
        >
        
            <div
                id="{{ $dataTableFingerprint }}-numberRange-{{ $filterKey }}-wrapper" data-ticks-position='bottom'
                @class([
                    'range-slider flat' => $isTailwind,
                    'tw4ph range-slider flat' => $isTailwind4,
                    'range-slider flat w-100' => $isBootstrap,
                ])
                style='--min:{{ $minRange }}; --max:{{ $maxRange }}; --value-a:{{ $currentMin }} --value-b:{{ $currentMax }} --text-value-a:"{{ $currentMin }}"; --text-value-b:"{{ $maxRange }}""; --suffix:"{{ $suffix }}"'
            >
                <input x-ref="min" type="range" min="{{ $minRange }}" max="{{ $maxRange }}" value="{{ $currentMin }}" 
                    id="{{ $dataTableFingerprint }}-numberRange-{{ $filterKey }}-min" x-model='filterMin' x-on:change="changeMin($refs.min.value); updateWire()"
                />
                <output></output>
                <input x-ref="max" type="range" min="{{ $minRange }}" max="{{ $maxRange }}" value="{{ $currentMax }}"
                    id="{{ $dataTableFingerprint }}-numberRange-{{ $filterKey }}-max" x-model='filterMax' x-on:change="changeMax($refs.max.value); updateWire()"
                />
                <output></output>
                <div class='range-slider__progress'></div>
            </div>
        </div>
    </div>
    <div class="col-start-12 row-start-1 text-right items-end justify-end min-h-7">
        <template x-if="($wire.get('appliedFilters.{{ $filter->getKey() }}') ?? null) !== null">
            <div class="w-1/12 inline-flex items-end justify-end ">
                <button @click="toggleStatusWithReset(); filterPopoverOpen = false;" {{ $this->getFilterMenuResetButtonAttributesBag->merge(['type' => 'button'])->class([
                            'w-min rounded-full focus:outline-none' => $isTailwind && ($this->getFilterMenuResetButtonAttributes['default-styling'] ?? true),    
                            'text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:bg-indigo-500 focus:text-white' => $isTailwind && ($this->getFilterMenuResetButtonAttributes['default-colors'] ?? true),    
                    ])->except(['default-colors','default-styling']) 
                }}>
                    <span class="sr-only">{{ __($localisationPath.'Remove filter option') }}</span>
                    <x-heroicon-m-x-mark class="h-6 w-6" />
                </button>
            </div>
        </template>  
    </div>
</div> 
