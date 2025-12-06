<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing\Helpers;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Collections\ColumnCollection;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

trait ColumnCollapsingHelpers
{
    /**
     * Determines if Current Table has any Collapsing Columns
     */
    #[Computed]
    public function hasCollapsingColumns(): bool
    {
        return $this->getCollapsingColumnsStatus() === true;
    }

    #[Computed]
    public function showCollapsingColumnSections(): bool
    {
        return $this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns();
    }

    #[Computed]
    public function hasCollapsedColumns(): bool
    {
        return $this->hasCollapsingColumns() && ($this->shouldCollapseOnMobile() || $this->shouldCollapseOnTablet() || $this->shouldCollapseAlways());
    }

    #[Computed]
    public function shouldCollapseOnMobile(): bool
    {

        if (! isset($this->shouldMobileCollapse)) {
            $this->shouldMobileCollapse = ($this->getCollapsedMobileColumnsCount() > 0);
        }

        return $this->shouldMobileCollapse;

    }

    /**
     * Gets Columns that Collapse On Mobile
     *
     * @return ColumnCollection<int|string,Column>
     */
    public function getCollapsedMobileColumns(): ColumnCollection
    {
        return $this->getColumns()
            ->visible()
            ->reject(fn (Column $column) => ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column)))
            ->filter(fn (Column $column) => $column->shouldCollapseOnMobile())
            ->values();
    }

    public function getCollapsedMobileColumnsCount(): int
    {
        return $this->getCollapsedMobileColumns()->count();
    }

    /**
     * Undocumented function
     *
     * @return ColumnCollection<int|string,Column>
     */
    public function getVisibleMobileColumns(): ColumnCollection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->shouldCollapseOnMobile())
            ->values();
    }

    public function getVisibleMobileColumnsCount(): int
    {
        return $this->getVisibleMobileColumns()->count();
    }

    #[Computed]
    public function shouldCollapseOnTablet(): bool
    {
        if (! isset($this->shouldTabletCollapse)) {
            $this->shouldTabletCollapse = ($this->getCollapsedTabletColumnsCount() > 0);
        }

        return $this->shouldTabletCollapse;

    }

    /**
     * Gets Columns that Collapse On Tablet
     *
     * @return ColumnCollection<int|string,Column>
     */
    public function getCollapsedTabletColumns(): ColumnCollection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => ($column->isHidden() || ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column))))
            ->filter(fn (Column $column) => $column->shouldCollapseOnTablet())
            ->values();
    }

    public function getCollapsedTabletColumnsCount(): int
    {
        return $this->getCollapsedTabletColumns()->count();
    }

    /**
     * Undocumented function
     *
     * @return ColumnCollection<int|string,Column>
     */
    public function getVisibleTabletColumns(): ColumnCollection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->shouldCollapseOnTablet())
            ->values();
    }

    public function getVisibleTabletColumnsCount(): int
    {
        return $this->getVisibleTabletColumns()->count();
    }

    /**
     * Gets Columns that Collapse Always
     *
     * @return ColumnCollection<int|string,Column>
     */
    public function getCollapsedAlwaysColumns(): ColumnCollection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => ($column->isHidden() || ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column))))
            ->filter(fn (Column $column) => $column->shouldCollapseAlways())
            ->values();
    }

    public function getCollapsedAlwaysColumnsCount(): int
    {
        return $this->getCollapsedAlwaysColumns()->count();
    }

    #[Computed]
    public function shouldCollapseAlways(): bool
    {
        if (! isset($this->shouldAlwaysCollapse)) {
            $this->shouldAlwaysCollapse = ($this->getCollapsedAlwaysColumnsCount() > 0);
        }

        return $this->shouldAlwaysCollapse;
    }

    #[Computed]
    public function getColspanCount(): int
    {
        return 100;
    }

    /**
     * Undocumented function
     *
     * @return ColumnCollection<int|string,Column>
     */
    #[Computed]
    public function getCollapsedColumnsForContent(): ColumnCollection
    {
        $colspan = $this->getColspanCount();
        $columns = $this->getColumns()
            ->reject(fn (Column $column) => ($column->isHidden() || ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column))))
            ->reject(fn (Column $column) => $column->shouldNeverCollapse());

        return $columns;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getCollapsedColumnsForContentNew(): array
    {
        $extras = [];

        foreach ($this->getCollapsedColumnsForContent() as $index => $col) {
            if ($this->isTailwind()) {
                $classes = 'block mb-2';
                if (! $col->shouldCollapseAlways() && $col->shouldCollapseOnMobile() && ! $col->shouldCollapseOnTablet()) {
                    $classes .= ' sm:block md:hidden';
                }
                if (! $col->shouldCollapseAlways() && ($col->shouldCollapseOnMobile() || $col->shouldCollapseOnTablet())) {
                    $classes .= ' sm:block lg:hidden';
                }

            } elseif ($this->isTailwind4()) {
                $classes = 'block mb-2';
                if (! $col->shouldCollapseAlways() && $col->shouldCollapseOnMobile() && ! $col->shouldCollapseOnTablet()) {
                    $classes .= ' sm:block md:hidden';
                }
                if (! $col->shouldCollapseAlways() && ($col->shouldCollapseOnMobile() || $col->shouldCollapseOnTablet())) {
                    $classes .= ' sm:block lg:hidden';
                }

            } else {
                $classes = 'd-block mb-2';

                if (! $col->shouldCollapseAlways() && ! $col->shouldCollapseOnMobile() && ! $col->shouldCollapseOnTablet()) {
                    $classes .= ' d-sm-none';

                }
                if (! $col->shouldCollapseAlways() && $col->shouldCollapseOnMobile() && ! $col->shouldCollapseOnTablet()) {
                    $classes .= ' d-md-none';
                }

                if (! $col->shouldCollapseAlways() && ($col->shouldCollapseOnMobile() || $col->shouldCollapseOnTablet())) {
                    $classes .= ' d-lg-none';
                }

            }

            $extras[$index] = [
                'shouldCollapseAlways' => $col->shouldCollapseAlways(),
                'shouldCollapseOnTablet' => $col->shouldCollapseOnTablet(),
                'shouldCollapseOnMobile' => $col->shouldCollapseOnMobile(),
                'isHtml' => $col->isHtml(),
                'title' => $col->getTitle(),
                'classes' => $classes,
            ];

        }

        return $extras;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function getCollapsingColumnDetailsForView(): array
    {
        return [
            'colspanCount' => $this->getColspanCount(),
            'hasCollapsingColumns' => ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns()),
            'showCollapsingColumnSections' => $this->showCollapsingColumnSections(),
            'shouldCollapseAlways' => $this->shouldCollapseAlways(),
            'shouldCollapseOnTablet' => $this->shouldCollapseOnTablet(),
            'shouldCollapseOnMobile' => $this->shouldCollapseOnMobile(),
            'collapsingColumnDetails' => $this->getCollapsedColumnsForContentNew(),
            'collapsingColumnClasses' => $this->getCollapsingColumnClasses(),
            'buttonExpandAttributes' => $this->getCollapsingColumnButtonExpandAttributes(),
            'buttonCollapseAttributes' => $this->getCollapsingColumnButtonCollapseAttributes(),
        ];
    }
}
