<?php

namespace Rappasoft\LaravelLivewireTables\Features\Sorting;

use Rappasoft\LaravelLivewireTables\Collections\ColumnCollection;
use Rappasoft\LaravelLivewireTables\Features\Sorting\Concerns\HandlesSortingPills;
use Rappasoft\LaravelLivewireTables\Features\Sorting\Configuration\SortingConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Sorting\Helpers\SortingHelpers;
use Rappasoft\LaravelLivewireTables\Features\Sorting\QueryString\HasQueryStringForSort;
use Rappasoft\LaravelLivewireTables\Features\Sorting\Styling\HasSortingPillsStyling;

trait WithSorting
{
    use SortingConfiguration,
        SortingHelpers,
        HasQueryStringForSort,
        HandlesSortingPills,
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
     * @var ColumnCollection<int|string,\Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column>
     */
    protected ColumnCollection $sortableColumns;

    /**
     * Undocumented function
     */
    public function mountWithSorting(): void
    {
        $this->setupDefaultSorting();
    }

    public function renderingWithSorting(\Illuminate\View\View $view, array $data = []): void
    {
        $data = [
            'sortingIsEnabled' => $this->sortingIsEnabled(),
            'columnSortConfig' => [],
        ];
        if ($this->sortingIsEnabled()) {
            $columnSortConfig = [];
            foreach ($this->columns as $column) {
                $columnSortConfig[$column->getHash()] = $this->getAllThAttributes($column);
            }
            $data['columnSortConfig'] = $columnSortConfig;
        }
        $view->with($data);
    }
}
