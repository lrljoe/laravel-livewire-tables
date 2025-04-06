@aware(['isTailwind', 'isBootstrap'])
@if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
    <th scope="col" :class="{ 'laravel-livewire-tables-reorderingMinimised': ! currentlyReorderingStatus }" {{
        $attributes->merge()
            ->class($isTailwind ? [
                'table-cell dark:bg-gray-800 laravel-livewire-tables-reorderingMinimised',
                'sm:hidden' => !$this->shouldCollapseOnTablet() && !$this->shouldCollapseAlways(),
                'md:hidden' => !$this->shouldCollapseOnMobile() && !$this->shouldCollapseOnTablet() && !$this->shouldCollapseAlways(),
                'lg:hidden' =>  !$this->shouldCollapseAlways(),
            ] : [
                'd-table-cell laravel-livewire-tables-reorderingMinimised',
                'd-sm-none' => !$this->shouldCollapseOnTablet() && !$this->shouldCollapseAlways(),
                'd-md-none' => !$this->shouldCollapseOnMobile() && !$this->shouldCollapseOnTablet() && !$this->shouldCollapseAlways(),
                'd-lg-none' => !$this->shouldCollapseAlways(),
            ])
        }}></th>
@endif
