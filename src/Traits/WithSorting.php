<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\SortingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Core\QueryStrings\HasQueryStringForSort;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\SortingHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\HasSortingPillsStyling;

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
