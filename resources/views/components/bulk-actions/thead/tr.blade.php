@aware(['isTailwind', 'tableName'])
<x-livewire-tables::table.tr.plain {{ $attributes->merge(
    [
        'x-cloak' => '',
        'x-show' => 'selectedItems.length > 0 && !currentlyReorderingStatus',
        'data-id' => 'bil',
        'wire:key' => $tableName . "-bulk-select-message",

    ]
)->class(
    'bg-indigo-50 dark:bg-gray-900 dark:text-white' => $isTailwind,
) }}>
{{  $slot  }}
</x-livewire-tables::table.tr.plain>