@aware([ 'tableName', 'isTailwind', 'isBootstrap', 'localisationPath', 'collapsingColumnInfo','bulkActionsRowButtonAttributes'])

@php
    $colspan = $collapsingColumnInfo['colspanCount'];
    $selectAll = $this->selectAllIsEnabled();
    $simplePagination = $this->isPaginationMethod('simple');
@endphp


<x-livewire-tables::table.tr.plain
    x-cloak x-show="selectedItems.length > 0 && !currentlyReorderingStatus" data-id="bil"
    wire:key="{{ $tableName }}-bulk-select-message"
    @class([
        'bg-indigo-50 dark:bg-gray-900 dark:text-white' => $isTailwind,
    ])
    
>
    <x-livewire-tables::table.td.plain :colIndex="'bulkactions'" :colspan="$colspan">
        <template x-if="selectedItems.length >= paginationTotalItemCount">
            <div wire:key="{{ $tableName }}-all-selected">
                <span>
                    {{ __($localisationPath.'You are currently selecting all') }}
                    @if(!$simplePagination) <strong><span x-text="paginationTotalItemCount"></span></strong> @endif
                    {{ __($localisationPath.'rows') }}.
                </span>
                <x-livewire-tables::bulk-actions.thead.button x-on:click="clearSelected" >
                    {{ __($localisationPath.'Deselect All') }}
                </x-livewire-tables::bulk-actions.thead.button>
            </div>
        </template>

        <template x-if="selectedItems.length < paginationTotalItemCount">
            <div wire:key="{{ $tableName }}-some-selected">
                <span>
                    {{ __($localisationPath.'You have selected') }}
                    <strong><span x-text="selectedItems.length"></span></strong>
                    {{ __($localisationPath.'rows, do you want to select all') }}
                    @if(!$simplePagination) <strong><span x-text="paginationTotalItemCount"></span></strong> @endif
                </span>
                <x-livewire-tables::bulk-actions.thead.button x-on:click="selectAllOnPage()" >
                    {{ __($localisationPath.'Select All On Page') }}
                </x-livewire-tables::bulk-actions.thead.button>
                <x-livewire-tables::bulk-actions.thead.button x-on:click="setAllSelected()" >
                    {{ __($localisationPath.'Select All') }}
                </x-livewire-tables::bulk-actions.thead.button>
                <x-livewire-tables::bulk-actions.thead.button x-on:click="clearSelected" >
                    {{ __($localisationPath.'Deselect All') }}
                </x-livewire-tables::bulk-actions.thead.button>

            </div>
        </template>
    </x-livewire-tables::table.td.plain>
</x-livewire-tables::table.tr.plain>
