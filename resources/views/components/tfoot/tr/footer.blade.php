@aware([ 'dataTableFingerprint', 'selectedVisibleColumns','showBulkActionsSections','hasCollapsingColumns', 'filterGenericData'])

<x-livewire-tables::table.tr.plain :rowIndex="-1" data-id="tfoot"
    :customAttributes="$this->getFooterTrAttributes($this->getRows)"
    wire:key="{{ $dataTableFingerprint .'-footer' }}"
>
    @if ($showBulkActionsSections)
        <x-livewire-tables::table.td.plain :colIndex="'bulkactions'" :displayMinimisedOnReorder="true" wire:key="{{ $dataTableFingerprint .'-footer-hasBulkActions' }}" />
    @endif

    @if ($hasCollapsingColumns)
        <x-livewire-tables::collapsed-columns.td :hidden=true :displayMinimisedOnReorder="true" wire:key="{{ $dataTableFingerprint .'-footer-collapsed-hide' }}"  />
    @endif


    @tableloop($selectedVisibleColumns as $colIndex => $column)
        @if($column->hasFooter() && $column->hasFooterCallback())

            <x-livewire-tables::table.td.plain wire:key="{{ $dataTableFingerprint . '-footer-datatable-td-' . $column->getSlug() }}"  :$column :$colIndex  :customAttributes="$this->getFooterTdAttributes($column, $this->getRows, $colIndex)">

                    @if($column->footerCallbackIsFilter())
                        {{ $column->getFooterFilter($column->getFooterCallback(), $filterGenericData) }}
                    @elseif($column->footerCallbackIsString())
                        {{ $column->getFooterFilter($this->getFilterByKey($column->getFooterCallback()), $filterGenericData) }}
                    @else
                        {{ $column->getNewFooterContents($this->getRows) }}
                    @endif
            </x-livewire-tables::table.td.plain>
        @else
            <x-livewire-tables::table.td.plain wire:key="{{ $dataTableFingerprint . '-footer-header-datatable-td-' . $column->getSlug() }}"  :$column :$colIndex />
        @endif
    @endtableloop
</x-livewire-tables::table.tr.plain>
