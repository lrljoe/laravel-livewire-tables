@aware([ 'tableName', 'isTailwind', 'isTailwind4', 'isBootstrap', 'localisationPath', 'collapsingColumnInfo','bulkActionsRowButtonAttributes'])

@php
    $colspan = $collapsingColumnInfo['colspanCount'];
    $selectAll = $this->selectAllIsEnabled();
    $simplePagination = $this->isPaginationMethod('simple');
@endphp
    

<tr  {{ $this->getBulkActionsAlpine()->merge(['data-id' => "bil",
                'wire:key' => $this->getTableName() ."-bulk-select-message",
                'x-cloak' => ''])
        ->class([
            'unsortable laravel-livewire-tables-reorderingMinimised bg-indigo-50 dark:bg-gray-900 dark:text-white' => $isTailwind,
            'tw4ph unsortable laravel-livewire-tables-reorderingMinimised bg-indigo-50 dark:bg-gray-900 dark:text-white' => $isTailwind4,
            'laravel-livewire-tables-reorderingMinimised' => $isBootstrap,
            '' => $isBootstrap && ($customAttributes['default'] ?? true),
        ])
        ->except(['default','default-styling','default-colors'])
    }}
>
    <x-livewire-tables::table.td.plain :colIndex="'bulkactions'" :colspan="$colspan">
            <div wire:key="{{ $tableName }}-selected-items">
                <span x-cloak x-show="selectedItems.length >= paginationTotalItemCount">
                    {{ __($localisationPath.'You are currently selecting all') }}
                    @if(!$simplePagination) <strong><span x-text="paginationTotalItemCount"></span></strong> @endif
                    {{ __($localisationPath.'rows') }}.
                </span>
                <span x-cloak x-show="selectedItems.length < paginationTotalItemCount">
                    {{ __($localisationPath.'You have selected') }}
                    <strong><span x-text="selectedItems.length"></span></strong>
                    {{ __($localisationPath.'rows, do you want to select all') }}
                    @if(!$simplePagination) <strong><span x-text="paginationTotalItemCount"></span></strong> @endif
                </span>
                <x-livewire-tables::bulk-actions.thead.button x-on:click="selectAllOnPage" x-show="selectedItems.length < paginationTotalItemCount" >
                    {{ __($localisationPath.'Select All On Page') }}
                </x-livewire-tables::bulk-actions.thead.button>
                <x-livewire-tables::bulk-actions.thead.button x-on:click="setAllSelected" x-show="selectedItems.length < paginationTotalItemCount" >
                    {{ __($localisationPath.'Select All') }}
                </x-livewire-tables::bulk-actions.thead.button>
                <x-livewire-tables::bulk-actions.thead.button x-on:click="clearSelected" >
                    {{ __($localisationPath.'Deselect All') }}
                </x-livewire-tables::bulk-actions.thead.button>
                <x-livewire-tables::bulk-actions.thead.button x-on:click="deselectAllOnPage" >
                    {{ __($localisationPath.'Deselect All On Page') }}
                </x-livewire-tables::bulk-actions.thead.button>

                
            </div>
    </x-livewire-tables::table.td.plain>
</tr>
