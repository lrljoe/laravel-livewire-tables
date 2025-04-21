@aware(['tableName'])
@props(['coreTableAttributes' => []])

<tfoot wire:key="{{ $tableName }}-tfoot" class="unsortable" data-id="tfoot">
    @if($this->shouldShowFooter())

        @if ($this->useHeaderAsFooterIsEnabled())
            <x-livewire-tables::table.thead.tr.secondary-header  />
        @else
            <x-livewire-tables::table.tfoot.tr.footer  />
        @endif
    @endif
    @if($this->shouldShowColumnTitlesInFooter())
        <x-livewire-tables::table.tfoot.tr.footer-titles />
    @endif
</tfoot>