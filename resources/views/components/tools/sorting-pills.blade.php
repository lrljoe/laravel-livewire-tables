@aware([ 'dataTableFingerprint','isTailwind','isTailwind4', 'isBootstrap','isBootstrap4','isBootstrap5', 'localisationPath'])

@php($sortingPillsItemAttributes = $this->getSortingPillsItemAttributes())
@php($sortingPillsClearSortButtonAttributes = $this->getSortingPillsClearSortButtonAttributes())
@php($sortingPillsClearAllButtonAttributes = $this->getSortingPillsClearAllButtonAttributes())

@if ($isTailwind)
    <div>
        <div class="mb-4 px-4 md:p-0" x-cloak x-show="!currentlyReorderingStatus">
            <small class="text-gray-700 dark:text-white">{{ __($localisationPath.'Applied Sorting') }}:</small>
            @tableloop($this->getSortsForPills() as $index => $sortColumnDetails)

                <span
                    wire:key="{{ $dataTableFingerprint }}-sorting-pill-{{ $index }}-{{ $sortColumnDetails['columnSelectName'] }}"
                    {{
                        $attributes->merge($sortingPillsItemAttributes)
                        ->class([
                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4' => $sortingPillsItemAttributes['default-styling'],
                            'bg-indigo-100 text-indigo-800 dark:bg-indigo-200 dark:text-indigo-900' => $sortingPillsItemAttributes['default-colors'],
                        ])
                        ->except(['default-styling', 'default-colors'])
                    }}
                >
                    {{ $sortColumnDetails['sortingPillTitle'] }}: {{ $sortColumnDetails['sortingPillDirectionLabel'] }}

                    <button
                        wire:click="clearSort('{{ $sortColumnDetails['columnSelectName'] }}')"
                        type="button"
                        {{
                            $attributes->merge($sortingPillsClearSortButtonAttributes)
                            ->class([
                                'flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center focus:outline-none' => $sortingPillsClearSortButtonAttributes['default-styling'],
                                'text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:bg-indigo-500 focus:text-white' => $sortingPillsClearSortButtonAttributes['default-colors'],
                            ])
                            ->except(['default-styling', 'default-colors'])
                        }}
                    >
                        <span class="sr-only">{{ __($localisationPath.'Remove sort option') }}</span>
                        <x-heroicon-m-x-mark class="h-3 w-3" />
                    </button>
                </span>
            @endtableloop

            <button
                wire:click.prevent="clearSorts"
                class="focus:outline-none active:outline-none"
            >
                <span
                    {{
                        $attributes->merge($sortingPillsClearAllButtonAttributes)
                        ->class([
                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium' => $sortingPillsClearAllButtonAttributes['default-styling'],
                            'bg-gray-100 text-gray-800 dark:bg-gray-200 dark:text-gray-900' => $sortingPillsClearAllButtonAttributes['default-colors'],
                        ])
                        ->except(['default-styling', 'default-colors'])
                    }}
                >
                    {{ __($localisationPath.'Clear') }}
                </span>
            </button>
        </div>
    </div>
@elseif($isTailwind4)
    <div>
        <div class="mb-4 px-4 md:p-0" x-cloak x-show="!currentlyReorderingStatus">
            <small class="text-gray-700 dark:text-white">{{ __($localisationPath.'Applied Sorting') }}:</small>
            @tableloop($this->getSortsForPills() as $columnSelectName => $sortColumnDetails)

                <span
                    wire:key="{{ $dataTableFingerprint }}-sorting-pill-{{ $columnSelectName }}"
                    {{
                        $attributes->merge($sortingPillsItemAttributes)
                        ->class([
                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4' => $sortingPillsItemAttributes['default-styling'],
                            'bg-indigo-100 text-indigo-800 dark:bg-indigo-200 dark:text-indigo-900' => $sortingPillsItemAttributes['default-colors'],
                        ])
                        ->except(['default-styling', 'default-colors'])
                    }}
                >
                    {{ $sortColumnDetails['sortingPillTitle'] }}: {{ $sortColumnDetails['sortingPillDirectionLabel'] }}

                    <button
                        wire:click="clearSort('{{ $columnSelectName }}')"
                        type="button"
                        {{
                            $attributes->merge($sortingPillsClearSortButtonAttributes)
                            ->class([
                                'flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center focus:outline-none' => $sortingPillsClearSortButtonAttributes['default-styling'],
                                'text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:bg-indigo-500 focus:text-white' => $sortingPillsClearSortButtonAttributes['default-colors'],
                            ])
                            ->except(['default-styling', 'default-colors'])
                        }}
                    >
                        <span class="sr-only">{{ __($localisationPath.'Remove sort option') }}</span>
                        <x-heroicon-m-x-mark class="h-3 w-3" />
                    </button>
                </span>
            @endtableloop

            <button
                wire:click.prevent="clearSorts"
                class="focus:outline-none active:outline-none"
            >
                <span
                    {{
                        $attributes->merge($sortingPillsClearAllButtonAttributes)
                        ->class([
                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium' => $sortingPillsClearAllButtonAttributes['default-styling'],
                            'bg-gray-100 text-gray-800 dark:bg-gray-200 dark:text-gray-900' => $sortingPillsClearAllButtonAttributes['default-colors'],
                        ])
                        ->except(['default-styling', 'default-colors'])
                    }}
                >
                    {{ __($localisationPath.'Clear') }}
                </span>
            </button>
        </div>
    </div>
@elseif ($isBootstrap4)
    <div>
        @if ($this->sortingPillsAreEnabled() && $this->hasSorts())
            <div class="mb-3" x-cloak x-show="!currentlyReorderingStatus">
                <small>{{ __($localisationPath.'Applied Sorting') }}:</small>

                @foreach($this->getSorts() as $columnSelectName => $direction)
                    @php($column = $this->getColumnBySelectName($columnSelectName) ?? $this->getColumnBySlug($columnSelectName))

                    @continue(is_null($column))
                    @continue($column->isHidden())
                    @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

                    <span
                        wire:key="{{ $dataTableFingerprint . '-sorting-pill-' . $columnSelectName }}"
                        {{
                            $attributes->merge($sortingPillsItemAttributes)
                            ->class([
                                'badge badge-pill badge-info d-inline-flex align-items-center' => $sortingPillsItemAttributes['default-styling'],
                            ])
                            ->except(['default-styling', 'default-colors'])
                        }}
                    >
                        {{ $column->getSortingPillTitle() }}: {{ $column->getSortingPillDirectionLabel($direction, $this->getDefaultSortingLabelAsc(), $this->getDefaultSortingLabelDesc()) }}

                        <a
                            href="#"
                            wire:click="clearSort('{{ $columnSelectName }}')"
                            {{
                                $attributes->merge($sortingPillsClearSortButtonAttributes)
                                ->class([
                                    'text-white ml-2' => $sortingPillsClearSortButtonAttributes['default-styling'],
                                ])
                                ->except(['default-styling', 'default-colors'])
                            }}
                        >
                            <span class="sr-only">{{ __($localisationPath.'Remove sort option') }}</span>
                            <x-heroicon-m-x-mark class="laravel-livewire-tables-btn-smaller" />
                        </a>
                    </span>
                @endforeach

                <a
                    href="#"
                    wire:click.prevent="clearSorts"
                    {{
                        $attributes->merge($sortingPillsClearAllButtonAttributes)
                        ->class([
                            'badge badge-pill badge-light' => $sortingPillsClearAllButtonAttributes['default-styling'],
                        ])
                        ->except(['default-styling', 'default-colors'])
                    }}
                >
                    {{ __($localisationPath.'Clear') }}
                </a>
            </div>
        @endif
    </div>
@elseif ($isBootstrap5)
    <div>
        @if ($this->sortingPillsAreEnabled() && $this->hasSorts())
            <div class="mb-3" x-cloak x-show="!currentlyReorderingStatus">
                <small>{{ __($localisationPath.'Applied Sorting') }}:</small>

                @foreach($this->getSorts() as $columnSelectName => $direction)
                    @php($column = $this->getColumnBySelectName($columnSelectName) ?? $this->getColumnBySlug($columnSelectName))

                    @continue(is_null($column))
                    @continue($column->isHidden())
                    @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

                    <span
                        wire:key="{{ $dataTableFingerprint }}-sorting-pill-{{ $columnSelectName }}"
                        {{
                            $attributes->merge($sortingPillsItemAttributes)
                            ->class([
                                'badge rounded-pill bg-info d-inline-flex align-items-center' => $sortingPillsItemAttributes['default-styling'],
                            ])
                            ->except(['default-styling', 'default-colors'])
                        }}
                    >
                        {{ $column->getSortingPillTitle() }}: {{ $column->getSortingPillDirectionLabel($direction, $this->getDefaultSortingLabelAsc(), $this->getDefaultSortingLabelDesc()) }}

                        <a
                            href="#"
                            wire:click="clearSort('{{ $columnSelectName }}')"
                            {{
                                $attributes->merge($sortingPillsClearSortButtonAttributes)
                                ->class([
                                    'text-white ms-2' => $sortingPillsClearSortButtonAttributes['default-styling'],
                                ])
                                ->except(['default-styling', 'default-colors'])
                            }}
                        >
                            <span class="visually-hidden">{{ __($localisationPath.'Remove sort option') }}</span>
                            <x-heroicon-m-x-mark class="laravel-livewire-tables-btn-smaller" />
                        </a>
                    </span>
                @endforeach

                <a
                    href="#"
                    wire:click.prevent="clearSorts"
                    {{
                        $attributes->merge($sortingPillsClearAllButtonAttributes)
                        ->class([
                            'badge rounded-pill bg-light text-dark text-decoration-none' => $sortingPillsClearAllButtonAttributes['default-styling'],
                        ])
                        ->except(['default-styling', 'default-colors'])
                    }}
                >
                    {{ __($localisationPath.'Clear') }}
                </a>
            </div>
        @endif
    </div>
@endif
