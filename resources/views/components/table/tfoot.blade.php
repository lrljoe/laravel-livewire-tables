@aware(['tableName', 'primaryKey','isTailwind','isBootstrap'])
<x-slot name="tfoot">
    @if ($this->useHeaderAsFooterIsEnabled())
        <x-livewire-tables::table.tr.secondary-header  />
    @else
        <x-livewire-tables::table.tr.footer  />
    @endif
</x-slot>
