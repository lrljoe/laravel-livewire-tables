@aware([ 'tableName','showBulkActionsSections', 'selectedVisibleColumns', 'hasCollapsingColumns', 'filterGenericData', 'currentRows'])

<x-livewire-tables::table.tr.plain :rowIndex="-1"
    :customAttributes="$this->getSecondaryHeaderTrAttributes($currentRows)"
    wire:key="{{ $tableName .'-secondary-header' }}" data-id="temp"
>
    @if ($showBulkActionsSections)
        <x-livewire-tables::table.td.plain :colIndex="'bulkactions'" :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'-header-hasBulkActions' }}" />
    @endif

    @if ($hasCollapsingColumns)
        <x-livewire-tables::collapsed-columns.td :hidden=true :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'header-collapsed-hide' }}"  />
    @endif

    @tableloop($selectedVisibleColumns as $colIndex => $column)
        @if($column->hasSecondaryHeader() && $column->hasSecondaryHeaderCallback())
            <x-livewire-tables::table.td.plain wire:key="{{ $tableName . '-secondary-header-datatable-td-' . $column->getSlug() }}"  :$column :$colIndex  :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $currentRows, $colIndex)">
                    @if( $column->secondaryHeaderCallbackIsFilter())
                        {{ $column->getSecondaryHeaderFilter($column->getSecondaryHeaderCallback(), $filterGenericData) }}    
                    @elseif($column->secondaryHeaderCallbackIsString())
                        {{ $column->getSecondaryHeaderFilter($this->getFilterByKey($column->getSecondaryHeaderCallback()), $filterGenericData) }}
                    @else
                        {{ $column->getNewSecondaryHeaderContents($currentRows) }}
                    @endif
            </x-livewire-tables::table.td.plain>
        @else
            <x-livewire-tables::table.td.plain wire:key="{{ $tableName . '-secondary-header-datatable-td-' . $column->getSlug() }}"  :$column :$colIndex />

        @endif

    @endtableloop
</x-livewire-tables::table.tr.plain>
