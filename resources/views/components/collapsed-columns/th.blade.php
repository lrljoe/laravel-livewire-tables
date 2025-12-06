@aware(['isTailwind','isTailwind4', 'isBootstrap','collapsingColumnInfo'])
@if ($collapsingColumnInfo['hasCollapsingColumns'])
    <th scope="col" :class="{ 'laravel-livewire-tables-reorderingMinimised': ! currentlyReorderingStatus }" {{
        $attributes->merge()
            ->class($isTailwind ? [
                'table-cell dark:bg-gray-800 laravel-livewire-tables-reorderingMinimised',  
                'sm:hidden' => (!$collapsingColumnInfo['shouldCollapseOnTablet'] && !$collapsingColumnInfo['shouldCollapseAlways']),
                'md:hidden' => (!$collapsingColumnInfo['shouldCollapseOnMobile'] && !$collapsingColumnInfo['shouldCollapseOnTablet']  && !$collapsingColumnInfo['shouldCollapseAlways']),
                'lg:hidden' => (!$collapsingColumnInfo['shouldCollapseAlways']),
            ] : [])
            ->class($isTailwind4 ? [
                'tw4ph table-cell dark:bg-gray-800 laravel-livewire-tables-reorderingMinimised',  
                'tw4ph sm:hidden' => (!$collapsingColumnInfo['shouldCollapseOnTablet'] && !$collapsingColumnInfo['shouldCollapseAlways']),
                'tw4ph md:hidden' => (!$collapsingColumnInfo['shouldCollapseOnMobile'] && !$collapsingColumnInfo['shouldCollapseOnTablet']  && !$collapsingColumnInfo['shouldCollapseAlways']),
                'tw4ph lg:hidden' => (!$collapsingColumnInfo['shouldCollapseAlways']),
            ] : [])
            ->class($isBootstrap ? [
                'd-table-cell laravel-livewire-tables-reorderingMinimised',  
                'd-sm-none' => (!$collapsingColumnInfo['shouldCollapseOnTablet']  && !$collapsingColumnInfo['shouldCollapseAlways']),
                'd-md-none' => (!$collapsingColumnInfo['shouldCollapseOnMobile'] && !$collapsingColumnInfo['shouldCollapseOnTablet'])  && !$collapsingColumnInfo['shouldCollapseAlways'],
                'd-lg-none' => (!$collapsingColumnInfo['shouldCollapseAlways']),
            ] : [])

        }}
    ></th>
@endif
