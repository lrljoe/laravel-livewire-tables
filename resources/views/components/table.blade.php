@aware(['tableName','isTailwind', 'isTailwind4', 'isBootstrap', 'currentlyReorderingStatus', 'showCollapsingColumnSections','selectedVisibleColumns'])
@props(['bulkActionsTdAttributes','bulkActionsTdCheckboxAttributes'])

@php($coreTableAttributes = $this->getCoreTableAttributes())

<div >
<div {{ $attributes->merge($coreTableAttributes['wrapper'])
        ->class($isTailwind ? [
            'border-gray-200 dark:border-gray-700' => $coreTableAttributes['wrapper']['default-colors'] ?? ($coreTableAttributes['wrapper']['default'] ?? false),
            'shadow overflow-y-auto border-b sm:rounded-lg' => $coreTableAttributes['wrapper']['default-styling'] ?? ($coreTableAttributes['wrapper']['default'] ?? false),
        ] :
        [
            '' => $coreTableAttributes['wrapper']['default-colors'] ?? ($coreTableAttributes['wrapper']['default'] ?? true),
            'table-responsive' => $coreTableAttributes['wrapper']['default-styling'] ?? ($coreTableAttributes['wrapper']['default'] ?? true),
        ])
        ->except(['default','default-styling','default-colors'])
}}>
    <table {{ $attributes->merge($coreTableAttributes['table'])
            ->class($isTailwind ? [
                'rappasoft-livewire-table-new',
                'divide-gray-200 dark:divide-none' => $coreTableAttributes['table']['default-colors'] ?? ($coreTableAttributes['table']['default'] ?? true),
                'min-w-full divide-y' => $coreTableAttributes['table']['default-styling'] ?? ($coreTableAttributes['table']['default'] ?? true),
            ] : [
                '' => $coreTableAttributes['table']['default-colors'] ?? ($coreTableAttributes['table']['default'] ?? true),
                'laravel-livewire-table table' => $coreTableAttributes['table']['default-styling'] ?? ($coreTableAttributes['table']['default'] ?? true),
            ])
            ->except(['default','default-styling','default-colors']) }} 
            @if($currentlyReorderingStatus) 
            x-sort
            x-sort:config="{ 
                group: 'table-{{ $tableName }}',
                filter: '.unsortable',
                onMove: function (e) { 
                    return e.related.className.indexOf('unsortable') === -1;  
                },
                store: {
                    /**
                    * Save the order of elements. Called onEnd (when the item is dropped).
                    * @param {Sortable}  sortable
                    */
                    set: function (sortable) {
                        var order = sortable.toArray();
                        console.log('Storing Order');
                        const result = order.filter((word) => (word !== 'thead' && word !== 'tfoot' && word !== 'loading'));
                        console.log(result);

                        localStorage.setItem(sortable.options.group.name, result.join('|'));
                    }
	} }" @endif
    >
        <x-livewire-tables::table.thead.thead :$coreTableAttributes />

        {{ $slot }}

        <x-livewire-tables::table.tfoot.tfoot :$coreTableAttributes />


    </table>
</div>
                </div>