<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait CollapsingColumnHelpers
{
    
    /**
     * Determines if Collapsing Columns Status Is True
     *
     * @return boolean
     */
    public function getCollapsingColumnsStatus(): bool
    {
        return $this->collapsingColumnsStatus;
    }

    /**
     * Determines if Current Table has any Collapsing Columns
     *
     * @return boolean
     */
    #[Computed]
    public function hasCollapsingColumns(): bool
    {
        return $this->getCollapsingColumnsStatus() === true;
    }

    /**
     * Determines that Current Table has any Collapsing Columns
     *
     * @return boolean
     */
    #[Computed]
    public function collapsingColumnsAreEnabled(): bool
    {
        return $this->getCollapsingColumnsStatus() === true;
    }

    /**
     * Determines that Current Table does not have any Collapsing Columns
     *
     * @return boolean
     */
    #[Computed]
    public function collapsingColumnsAreDisabled(): bool
    {
        return $this->getCollapsingColumnsStatus() === false;
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
     * @return Collection
     */
    public function getCollapsedMobileColumns(): Collection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => ($column->isHidden() || ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column))))
            ->filter(fn (Column $column) => $column->shouldCollapseOnMobile())
            ->values();
    }

    public function getCollapsedMobileColumnsCount(): int
    {
        return $this->getCollapsedMobileColumns()->count();
    }

    public function getVisibleMobileColumns(): Collection
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
     * @return Collection
     */
    public function getCollapsedTabletColumns(): Collection
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

    public function getVisibleTabletColumns(): Collection
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
     * @return Collection
     */
    public function getCollapsedAlwaysColumns(): Collection
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

    #[Computed]
    public function getCollapsedColumnsForContent(): Collection
    {
        $colspan = $this->getColspanCount();
        $columns = $this->getColumns()
            ->reject(fn (Column $column) => ($column->isHidden() || ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column))))
            ->reject(fn (Column $column) => $column->shouldNeverCollapse());

        return $columns;
    }

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
