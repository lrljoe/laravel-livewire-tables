@aware(['dataTableFingerprint','coreTableAttributes'])

<tfoot wire:key="{{ $dataTableFingerprint }}-tfoot" class="unsortable" data-id="tfoot">
    
    @if($this->shouldShowFooter())
        @if ($this->useHeaderAsFooterIsEnabled() && $this->shouldShowSecondaryHeader())
            <x-livewire-tables::thead.tr.secondary-header  />
        @else
            <x-livewire-tables::tfoot.tr.footer  />
        @endif
    @endif

    @if($this->shouldShowColumnTitlesInFooter())
        <x-livewire-tables::tfoot.tr.footer-titles />
    @endif
</tfoot>