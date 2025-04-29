@aware(['isTailwind', 'isBootstrap','collapsingColumnInfo'])
@if ($collapsingColumnInfo['hasCollapsingColumns'])
    <th scope="col" :class="{ 'laravel-livewire-tables-reorderingMinimised': ! currentlyReorderingStatus }" {{
        $attributes->merge()
            ->class($isTailwind ? [
                'table-cell dark:bg-gray-800 laravel-livewire-tables-reorderingMinimised',  
                'sm:hidden' => !$collapsingColumnInfo['shouldCollapseOnTablet'] && !$collapsingColumnInfo['shouldCollapseAlways'],
                'md:hidden' => !$collapsingColumnInfo['shouldCollapseOnMobile'] && !$collapsingColumnInfo['shouldCollapseOnTablet']  && !$collapsingColumnInfo['shouldCollapseAlways'],
                'lg:hidden' =>  !$collapsingColumnInfo['shouldCollapseAlways'],
            ] : [
                'd-table-cell laravel-livewire-tables-reorderingMinimised',
                'd-sm-none' => !$collapsingColumnInfo['shouldCollapseOnTablet']  && !$collapsingColumnInfo['shouldCollapseAlways'],
                'd-md-none' => !$collapsingColumnInfo['shouldCollapseOnMobile'] && !$collapsingColumnInfo['shouldCollapseOnTablet']  && !$collapsingColumnInfo['shouldCollapseAlways'],
                'd-lg-none' => !$collapsingColumnInfo['shouldCollapseAlways'],
            ])
        }}></th>
@endif
