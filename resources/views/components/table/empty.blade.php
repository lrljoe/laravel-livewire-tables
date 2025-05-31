@aware(['isTailwind','isTailwind4','isBootstrap', 'collapsingColumnInfo'])

<tr {{ $attributes->merge(['wire:key' => 'empty-message-'.$this->getId()]) }}>
    <td colspan="{{ $collapsingColumnInfo['colspanCount'] }}">
        @if ($isTailwind)
            <div class="flex justify-center items-center space-x-2 dark:bg-gray-800">
                <span class="font-medium py-8 text-gray-400 text-lg dark:text-white">{{ $this->getEmptyMessage() }}</span>
            </div>
        @elseif ($isTailwind4)
            <div class="flex justify-center items-center space-x-2 dark:bg-gray-800">
                <span class="font-medium py-8 text-gray-400 text-lg dark:text-white">{{ $this->getEmptyMessage() }}</span>
            </div>
        @elseif ($isBootstrap)
            {{ $this->getEmptyMessage() }}
        @endif
    </td>
</tr>
