@aware([ 'tableName', 'selectedVisibleColumns','showBulkActionsSections','hasCollapsingColumns', 'filterGenericData'])

<x-livewire-tables::table.tr.plain :rowIndex="-1" data-id="tfoot"
    :customAttributes="$this->getFooterTrAttributes($this->getRows)"
    wire:key="{{ $tableName .'-footer' }}"
>
    @if ($showBulkActionsSections)
        <x-livewire-tables::table.td.plain :colIndex="'bulkactions'" :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'-footer-hasBulkActions' }}" />
    @endif

    @if ($hasCollapsingColumns)
        <x-livewire-tables::collapsed-columns.td :hidden=true :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'footer-collapsed-hide' }}"  />
    @endif


    @tableloop($selectedVisibleColumns as $colIndex => $column)

        <x-livewire-tables::table.td.plain wire:key="{{ $tableName . '-footer-datatable-td-' . $column->getSlug() }}"  :$column :$colIndex  :customAttributes="$this->getFooterTdAttributes($column, $this->getRows, $colIndex)">

            @if($column->hasFooter() && $column->hasFooterCallback())
                @if($column->footerCallbackIsFilter())
                    {{ $column->getFooterFilter($column->getFooterCallback(), $filterGenericData) }}
                @elseif($column->footerCallbackIsString())
                    {{ $column->getFooterFilter($this->getFilterByKey($column->getFooterCallback()), $filterGenericData) }}
                @else
                    {{ $column->getNewFooterContents($this->getRows) }}
                @endif
            @endif

        </x-livewire-tables::table.td.plain>
        @endtableloop
</x-livewire-tables::table.tr.plain>
