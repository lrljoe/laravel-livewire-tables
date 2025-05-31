@aware(['isTailwind','isTailwind4', 'isBootstrap','collapsingColumnInfo'])
@if ($collapsingColumnInfo['hasCollapsingColumns'])
    <th scope="col" :class="{ 'laravel-livewire-tables-reorderingMinimised': ! currentlyReorderingStatus }" {{
        $attributes->merge()
            ->class([
                'table-cell dark:bg-gray-800 laravel-livewire-tables-reorderingMinimised' => $isTailwind,  
                'sm:hidden' => $isTailwind && (!$collapsingColumnInfo['shouldCollapseOnTablet'] && !$collapsingColumnInfo['shouldCollapseAlways']),
                'md:hidden' => $isTailwind && (!$collapsingColumnInfo['shouldCollapseOnMobile'] && !$collapsingColumnInfo['shouldCollapseOnTablet']  && !$collapsingColumnInfo['shouldCollapseAlways']),
                'lg:hidden' => $isTailwind && (!$collapsingColumnInfo['shouldCollapseAlways']),

                'tw4ph table-cell dark:bg-gray-800 laravel-livewire-tables-reorderingMinimised' => $isTailwind4,  
                'tw4ph sm:hidden' => $isTailwind4 && (!$collapsingColumnInfo['shouldCollapseOnTablet'] && !$collapsingColumnInfo['shouldCollapseAlways']),
                'tw4ph md:hidden' => $isTailwind4 && (!$collapsingColumnInfo['shouldCollapseOnMobile'] && !$collapsingColumnInfo['shouldCollapseOnTablet']  && !$collapsingColumnInfo['shouldCollapseAlways']),
                'tw4ph lg:hidden' => $isTailwind4 && (!$collapsingColumnInfo['shouldCollapseAlways']),

                'd-table-cell laravel-livewire-tables-reorderingMinimised' => $isBootstrap,  
                'd-sm-none' => $isBootstrap && (!$collapsingColumnInfo['shouldCollapseOnTablet']  && !$collapsingColumnInfo['shouldCollapseAlways']),
                'd-md-none' => $isBootstrap && (!$collapsingColumnInfo['shouldCollapseOnMobile'] && !$collapsingColumnInfo['shouldCollapseOnTablet'])  && !$collapsingColumnInfo['shouldCollapseAlways'],
                'd-lg-none' => $isBootstrap && (!$collapsingColumnInfo['shouldCollapseAlways']),
            ])
        }}
    ></th>
@endif
