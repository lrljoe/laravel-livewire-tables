@aware(['isTailwind', 'isTailwind4', 'tableName'])
<x-livewire-tables::table.tr.plain {{ $attributes->merge([
            'x-cloak' => '',
            'x-show' => 'selectedItems.length > 0 && !currentlyReorderingStatus',
            'data-id' => 'bil',
            'wire:key' => $tableName . "-bulk-select-message",
        ])
        ->class([
            //Tailwind3
            'bg-indigo-50 dark:bg-gray-900 dark:text-white' => $isTailwind,
            
            //Tailwind4
            'bg-indigo-50 dark:bg-gray-900 dark:text-white' => $isTailwind4,
        ])
    }}
>
    {{  $slot  }}
</x-livewire-tables::table.tr.plain>