@aware(['dataTableFingerprint'])
@php
    $filterKey = $filter->getKey();
    $currentMin = $minRange = $filter->getConfig('minRange');
    $currentMax = $maxRange = $filter->getConfig('maxRange');
    $suffix = $filter->hasConfig('suffix') ? '--suffix:"'. $filter->getConfig('suffix') .'";' : '';
    $prefix = $filter->hasConfig('prefix') ? '--prefix:"'.$filter->getConfig('prefix').'";' : '';
@endphp

<div id="{{ $dataTableFingerprint }}-numberRange-{{ $filterKey }}" x-data="numberRangeFilter($wire,'{{ $filterKey }}', '{{ $dataTableFingerprint }}-numberRange-{{ $filterKey }}-wrapper', @js($filter->getConfigs()), '{{ $dataTableFingerprint }}-numberRange-{{ $filterKey }}')" x-on:mousedown.away.throttle.2000ms="updateWireable" x-on:touchstart.away.throttle.2000ms="updateWireable" x-on:mouseleave.throttle.2000ms="updateWireable">
    <x-livewire-tables::tools.filter-label for="{{ $dataTableFingerprint.'-numberRange-'.$filterKey.'-min' }}" :$filter :$filterLayout  :$filterLabelAttributes :$customLabelAttributes />
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
            style=' --min:{{ $minRange }}; --max:{{ $maxRange }}; {{ $suffix . $prefix }}'
        >
            <input type="range" min="{{ $minRange }}" max="{{ $maxRange }}" value="{{ $currentMin }}"
                id="{{ $dataTableFingerprint }}-numberRange-{{ $filterKey }}-min" x-model='filterMin' x-on:change="updateWire()"
                oninput="this.parentNode.style.setProperty('--value-a',this.value); this.parentNode.style.setProperty('--text-value-a', JSON.stringify(this.value))"
            />
            <output></output>
            <input type="range" min="{{ $minRange }}" max="{{ $maxRange }}" value="{{ $currentMax }}"
                id="{{ $dataTableFingerprint }}-numberRange-{{ $filterKey }}-max" x-model='filterMax' x-on:change="updateWire()"
                oninput="this.parentNode.style.setProperty('--value-b',this.value); this.parentNode.style.setProperty('--text-value-b', JSON.stringify(this.value))"
            />
            <output></output>
            <div class='range-slider__progress'></div>
        </div>
    </div>
</div>
