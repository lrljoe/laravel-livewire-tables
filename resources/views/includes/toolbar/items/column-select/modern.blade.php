@aware([ 'dataTableFingerprint','isTailwind','isTailwind4','isBootstrap','isBootstrap4','isBootstrap5', 'localisationPath'])
@props(['jsoned'])
@php($columnSelectButtonAttributes = $this->getColumnSelectButtonAttributes())
@php($columnSelectMenuAttributes = $this->getColumnSelectMenuAttributes)
@php($columnSelectMenuOptionCheckboxAttributes = $this->getColumnSelectMenuOptionCheckboxAttributes)
@php($selectableSelectedColumnCount = $this->getSelectableSelectedColumns()->count())
@php($columnSelectItems = $this->generateColumnSelectItems())

<div x-data="columnSelect($wire)"
        @keydown.window.escape="if (!childElementOpen) { open = false }"
        x-on:click.away="if (!childElementOpen) { open = false; }"

>
    @if ($isTailwind || $isTailwind4)
        <div @class([
                'hidden sm:block' => $this->getColumnSelectIsHiddenOnMobile(),
                'hidden md:block mb-4 w-full md:w-auto md:mb-0 md:ml-2' => $this->getColumnSelectIsHiddenOnTablet(),
            ])
        >
            <div class="inline-block relative w-full text-left md:w-auto"
                wire:key="{{ $dataTableFingerprint }}-column-select-menu"
            >
                <div class="rounded-md shadow-sm">
                    <button
                        wire:key="{{ $dataTableFingerprint }}-column-select-button"
                        x-on:click="open = !open"
                        type="button"
                        {{
                            $attributes->merge($columnSelectButtonAttributes)
                            ->class([
                                'inline-flex justify-center px-4 py-2 w-full text-sm font-medium rounded-md border shadow-sm focus:ring focus:ring-opacity-50' => $isTailwind && $columnSelectButtonAttributes['default-styling'],
                                'inline-flex justify-center px-4 py-2 w-full text-sm font-weight-500 rounded-md border shadow-sm focus:ring focus:ring-opacity-50/100' => $isTailwind4 && $columnSelectButtonAttributes['default-styling'],
                                'text-gray-700 bg-white border-gray-300 hover:bg-gray-50 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $columnSelectButtonAttributes['default-colors'],
                            ])
                            ->except(['default-styling', 'default-colors'])
                        }}
                        aria-haspopup="true"
                        x-bind:aria-expanded="open"
                        aria-expanded="true"
                    >
                        {{ __($localisationPath.'Columns') }}

                        <x-heroicon-m-chevron-down class="-mr-1 ml-2 h-5 w-5" />
                    </button>
                </div>

                <div x-cloak x-show="open" x-anchor.bottom-start="$refs.columnSelectButton" {{ 
                        $attributes->merge($columnSelectMenuAttributes)
                        ->class([
                            'divide-gray-100 ring-black bg-white dark:bg-gray-700 dark:text-white' => $isTailwind && ($columnSelectMenuAttributes['default-colors'] ?? true),
                            'z-50 mt-2 w-full rounded-md divide-y ring-1 ring-opacity-5 shadow-lg md:w-48 focus:outline-none' => $isTailwind && ($columnSelectMenuAttributes['default-styling'] ?? true),
                            'z-index-50 mt-2 w-full rounded-md divide-y ring-1 ring-opacity-5/100 shadow-lg md:w-48 focus:outline-none' => $isTailwind4 && ($columnSelectMenuAttributes['default-styling'] ?? true),
                        ])
                  }}
                >
                    <div class="p-2" 
                        role="menu" 
                        aria-orientation="vertical"
                        aria-labelledby="column-select-menu"
                        @click.outside="sendUpdate"
                    >
                        <div wire:key="{{ $dataTableFingerprint }}-columnSelect-selectAll-{{ rand(0,1000) }}">
                            <label
                                wire:loading.attr="disabled"
                                @class([
                                    'inline-flex items-center px-2 py-1 disabled:opacity-50 disabled:cursor-wait' => $isTailwind,
                                    'inline-flex items-center px-2 py-1 disabled:opacity-50/100 disabled:cursor-wait' => $isTailwind4,
                                ])
                                for="{{ $dataTableFingerprint }}-columnSelect-selectAll-checkbox" 
                            >
                                <x-livewire-tables::forms.checkbox
                                    ::checked="selectedCols.length == selectableColumnCount"
                                    id="{{ $dataTableFingerprint }}-columnSelect-selectAll-checkbox" 
                                    wire:key="{{ $dataTableFingerprint }}-columnSelect-selectAll-checkbox" 
                                    wire:target="selectedColumns"
                                    wire:loading.attr="disabled" 
                                    x-on:click="toggleAll"
                                    :checkboxAttributes=$columnSelectMenuOptionCheckboxAttributes
                                />
                                <span class="ml-2">{{ __($localisationPath.'All Columns') }}</span>
                            </label>
                        </div>

                        @foreach ($columnSelectItems as $index => $columnDetail)
                            <div wire:key="{{ $dataTableFingerprint }}-columnSelect-{{ $loop->index }}">
                                <label for="{{ $dataTableFingerprint . 'selectedItems-'.$columnDetail['slug'] }}"  @class([
                                    'inline-flex items-center px-2 py-1 disabled:opacity-50 disabled:cursor-wait' => $isTailwind,
                                    'inline-flex items-center px-2 py-1 disabled:opacity-50/100 disabled:cursor-wait' => $isTailwind4,
                                ])
                                >
                                    <x-livewire-tables::forms.alpineCheckbox
                                        id="{{ $dataTableFingerprint . 'selectedItems-'.$columnDetail['slug'] }}" 
                                        wire:key="{{ $dataTableFingerprint . 'selectedItems-'.$columnDetail['slug'] }}" 
                                        wire:target="selectedColumns"
                                        wire:loading.attr="disabled" 
                                        x-model='selectedCols'
                                        value="{{ $columnDetail['slug'] }}"
                                        :checkboxAttributes=$columnSelectMenuOptionCheckboxAttributes
                                    />
                                    <span class="ml-2">{{ $columnDetail['title'] }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @elseif ($isBootstrap)
        <div
            @class([
                'd-none d-sm mb-3 mb-md-0 pl-0 pl-md-2' => $csIsHiddenOnMobile && $isBootstrap4,
                'd-none d-md-block mb-3 mb-md-0 pl-0 pl-md-2' => $csIsHiddenOnTablet && $isBootstrap4,
                'd-none d-sm-block mb-3 mb-md-0 md-0 ms-md-2' => $csIsHiddenOnMobile && $isBootstrap5,
                'd-none d-md-block mb-3 mb-md-0 md-0 ms-md-2' => $csIsHiddenOnTablet && $isBootstrap5,
            ])
        >
            <div
                x-data="{ open: false, childElementOpen: false }"
                x-on:keydown.escape.stop="if (!childElementOpen) { open = false }"
                x-on:mousedown.away="if (!childElementOpen) { open = false }"
                @class([
                    'dropdown d-block d-md-inline' => $isBootstrap,
                ])
                wire:key="{{ $dataTableFingerprint }}-column-select-button"
            >
                <button
                    x-on:click="open = !open"
                    {{
                        $attributes->merge($columnSelectButtonAttributes)
                        ->class([
                            'btn dropdown-toggle d-block w-100 d-md-inline' => $columnSelectButtonAttributes['default-styling'],
                        ])
                        ->except(['default-styling', 'default-colors'])
                    }}
                    type="button" id="{{ $dataTableFingerprint }}-columnSelect" aria-haspopup="true"
                    x-bind:aria-expanded="open"
                >
                    {{ __($localisationPath.'Columns') }}
                </button>

                <div
                    x-bind:class="{ 'show': open }"
                    @class([
                        'dropdown-menu dropdown-menu-right w-100 mt-0 mt-md-3' => $isBootstrap4,
                        'dropdown-menu dropdown-menu-end w-100' => $isBootstrap5,
                    ])
                    aria-labelledby="columnSelect-{{ $dataTableFingerprint }}"
                >
                    @if($isBootstrap4)
                        <div wire:key="{{ $dataTableFingerprint }}-columnSelect-selectAll-{{ rand(0,1000) }}">
                            <label wire:loading.attr="disabled" class="px-2 mb-1">
                                <input
                                    wire:loading.attr="disabled"
                                    type="checkbox"
                                    @if($selectableSelectedColumnCount == $this->getSelectableColumns()->count()) checked wire:click="deselectAllColumns" @else unchecked wire:click="selectAllColumns" @endif
                                />

                                <span class="ml-2">{{ __($localisationPath.'All Columns') }}</span>


                            </label>
                        </div>
                    @elseif($isBootstrap5)
                        <div class="form-check ms-2" wire:key="{{ $dataTableFingerprint }}-columnSelect-selectAll-{{ rand(0,1000) }}">
                            <input
                                wire:loading.attr="disabled"
                                type="checkbox"
                                {{
                                    $attributes->merge($columnSelectMenuOptionCheckboxAttributes)
                                    ->class([
                                        'form-check-input' => $columnSelectMenuOptionCheckboxAttributes['default-styling'],
                                    ])
                                    ->except(['default-styling', 'default-colors'])
                                }}
                                @if($selectableSelectedColumnCount == $this->getSelectableColumns()->count()) checked wire:click="deselectAllColumns" @else unchecked wire:click="selectAllColumns" @endif
                            />

                            <label wire:loading.attr="disabled" class="form-check-label">
                                {{ __($localisationPath.'All Columns') }}
                            </label>
                        </div>
                    @endif

                    @foreach ($this->getColumnsForColumnSelect() as $columnSlug => $columnTitle)
                        <div
                            wire:key="{{ $dataTableFingerprint }}-columnSelect-{{ $loop->index }}"
                            @class([
                                'form-check ms-2' => $isBootstrap5,
                            ])
                        >
                            @if ($isBootstrap4)
                                <label
                                    wire:loading.attr="disabled"
                                    wire:target="selectedColumns"
                                    class="px-2 {{ $loop->last ? 'mb-0' : 'mb-1' }}"
                                >
                                    <input
                                        wire:model.live="selectedColumns"
                                        wire:target="selectedColumns"
                                        wire:loading.attr="disabled" type="checkbox"
                                        value="{{ $columnSlug }}"
                                    />
                                    <span class="ml-2">
                                        {{ $columnTitle }}
                                    </span>
                                </label>
                            @elseif($isBootstrap5)
                                <input
                                    wire:model.live="selectedColumns"
                                    wire:target="selectedColumns"
                                    wire:loading.attr="disabled"
                                    type="checkbox"
                                    {{
                                        $attributes->merge($columnSelectMenuOptionCheckboxAttributes)
                                        ->class([
                                            'form-check-input' => $columnSelectMenuOptionCheckboxAttributes['default-styling'],
                                        ])
                                        ->except(['default-styling', 'default-colors'])
                                    }}
                                    value="{{ $columnSlug }}"
                                />
                                <label
                                    wire:loading.attr="disabled"
                                    wire:target="selectedColumns"
                                    class="{{ $loop->last ? 'mb-0' : 'mb-1' }} form-check-label"
                                >
                                    {{ $columnTitle }}
                                </label>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
