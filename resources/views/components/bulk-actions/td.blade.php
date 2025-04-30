@aware([ 'tableName', 'isTailwind', 'rowPk', 'bulkActionsTdAttributes', 'bulkActionsTdCheckboxAttributes', 'showBulkActionsSections'])

@if ($showBulkActionsSections)
    <x-livewire-tables::table.td.plain wire:key="{{ $tableName }}-tbody-td-bulk-actions-td-{{ $rowPk }}" :displayMinimisedOnReorder="true"  :customAttributes=$bulkActionsTdAttributes>
        <div @class($isTailwind ? [
            'inline-flex rounded-md shadow-sm',
        ] : [
            'form-check',
        ])>
            <x-livewire-tables::forms.checkbox 
                wire:key="{{ $tableName . 'selectedItems-'.$rowPk }}" 
                value="{{ $rowPk }}"
                :checkboxAttributes=$bulkActionsTdCheckboxAttributes
            />
        </div>
    </x-livewire-tables::table.td.plain>
@endif
