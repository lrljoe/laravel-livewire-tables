@aware([ 'dataTableFingerprint', 'isTailwind', 'isTailwind4', 'isBootstrap','rowPk', 'bulkActionsTdAttributes', 'bulkActionsTdCheckboxAttributes', 'showBulkActionsSections'])

<x-livewire-tables::table.td.plain wire:key="{{ $dataTableFingerprint }}-tbody-td-bulk-actions-td-{{ $rowPk }}" :displayMinimisedOnReorder="true"  :customAttributes=$bulkActionsTdAttributes>
    <div @class([
        'inline-flex rounded-md shadow-sm' => $isTailwind,
        'tw4ph inline-flex rounded-md shadow-sm' => $isTailwind4,
        'form-check' => $isBootstrap,
    ])>
        <x-livewire-tables::forms.checkbox 
            wire:key="{{ $dataTableFingerprint . 'selectedItems-'.$rowPk }}" 
            value="{{ $rowPk }}"
            :checkboxAttributes=$bulkActionsTdCheckboxAttributes
        />
    </div>
</x-livewire-tables::table.td.plain>
