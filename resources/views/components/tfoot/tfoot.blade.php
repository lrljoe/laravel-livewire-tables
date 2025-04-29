@aware(['tableName','coreTableAttributes'])

<tfoot wire:key="{{ $tableName }}-tfoot" class="unsortable" data-id="tfoot">
    @if($this->shouldShowFooter())

        @if ($this->useHeaderAsFooterIsEnabled())
            <x-livewire-tables::thead.tr.secondary-header  />
        @else
            <x-livewire-tables::tfoot.tr.footer  />
        @endif
    @endif
    @if($this->shouldShowColumnTitlesInFooter())
        <x-livewire-tables::tfoot.tr.footer-titles />
    @endif
</tfoot>