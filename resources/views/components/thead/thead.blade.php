@aware(['isTailwind', 'currentlyReorderingStatus', 'showBulkActionsSections', 'coreTableAttributes'])

<thead {{ $attributes->merge($coreTableAttributes['thead'])
                ->class($isTailwind ? [
                    'bg-gray-50 dark:bg-gray-800' => $coreTableAttributes['thead']['default-colors'] ?? ($coreTableAttributes['thead']['default'] ?? true),
                    '' => $coreTableAttributes['thead']['default-styling'] ?? ($coreTableAttributes['thead']['default'] ?? true),
                    'unsortable',
                ] : [
                    '' => $coreTableAttributes['thead']['default-colors'] ?? ($coreTableAttributes['thead']['default'] ?? true),
                    '' => $coreTableAttributes['thead']['default-styling'] ?? ($coreTableAttributes['thead']['default'] ?? true),
                ])
                ->except(['default','default-styling','default-colors']) }}
                data-id="thead"
        >
        <x-livewire-tables::thead.tr.header-titles  />
        @if(!$currentlyReorderingStatus && $this->shouldShowSecondaryHeader())
            <x-livewire-tables::thead.tr.secondary-header  />
        @endif

        @if(!$currentlyReorderingStatus && $showBulkActionsSections)
            <x-livewire-tables::bulk-actions.thead  :displayMinimisedOnReorder="true" />
        @endif
</thead>
