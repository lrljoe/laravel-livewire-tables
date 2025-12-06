@aware(['dataTableFingerprint'])
<div>
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout  :$filterLabelAttributes :$customLabelAttributes />

    @if ($isTailwind || $isTailwind4)
    <div class="rounded-md shadow-sm">
    @endif
        <select multiple
            {!! $filter->getWireMethod('appliedFilters.'.$filter->getKey()) !!} {{ 
                $filterInputAttributes->merge([
                    'wire:key' => $filter->generateWireKey($dataTableFingerprint, 'multiselectdropdown'),
                ])
                ->class([
                    'block w-full transition duration-150 ease-in-out rounded-md shadow-sm focus:ring focus:ring-opacity-50' => $isTailwind && ($filterInputAttributes['default-styling'] ?? true),
                    'border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600' => $isTailwind && ($filterInputAttributes['default-colors'] ?? true),
                    
                    'tw4ph block w-full transition duration-150 ease-in-out rounded-md shadow-sm focus:ring focus:ring-opacity-50' => $isTailwind4 && ($filterInputAttributes['default-styling'] ?? true),
                    'tw4ph border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600' => $isTailwind4 && ($filterInputAttributes['default-colors'] ?? true),

                    'form-control' => $isBootstrap4 && ($filterInputAttributes['default-styling'] ?? true),
                    'form-select' => $isBootstrap5 && ($filterInputAttributes['default-styling'] ?? true),
                ])
                ->except(['default-styling','default-colors']) 
            }}>
        @if ($filter->getFirstOption() !== '')
            <option @if($filter->isEmpty($this)) selected @endif value="all">{{ $filter->getFirstOption()}}</option>
        @endif
            @foreach($filter->getOptions() as $key => $value)
                @if (is_iterable($value))
                    <optgroup label="{{ $key }}">
                        @foreach ($value as $optionKey => $optionValue)
                            <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                        @endforeach
                    </optgroup>
                @else
                    <option value="{{ $key }}">{{ $value }}</option>
                @endif
            @endforeach
        </select>
    @if ($isTailwind || $isTailwind4)
    </div>
    @endif
</div>
