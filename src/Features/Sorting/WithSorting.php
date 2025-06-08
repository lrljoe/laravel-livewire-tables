<?php

namespace Rappasoft\LaravelLivewireTables\Features\Sorting;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Features\Sorting\Configuration\SortingConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Sorting\QueryString\HasQueryStringForSort;
use Rappasoft\LaravelLivewireTables\Features\Sorting\Helpers\SortingHelpers;
use Rappasoft\LaravelLivewireTables\Features\Sorting\Styling\HasSortingPillsStyling;

trait WithSorting
{
    use SortingConfiguration,
        SortingHelpers,
        HasQueryStringForSort,
        HasSortingPillsStyling;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $sorts = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $sortingConfig = [
        'defaultSortColumn' => null,
        'defaultSortDirection' => 'asc',
        'defaultSortingLabelAsc' => 'A-Z',
        'defaultSortingLabelDesc' => 'Z-A',
        'singleColumnSortingStatus' => true,
        'sortingPillsStatus' => true,
        'sortingStatus' => true,
    ];

    /**
     * Undocumented variable
     *
     * @var Collection<int,string>
     */
    protected Collection $sortableColumns;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function mountWithSorting(): void
    {
        $this->setupDefaultSorting();
    }

    
}
