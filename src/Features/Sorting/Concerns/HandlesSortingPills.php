<?php

namespace Rappasoft\LaravelLivewireTables\Features\Sorting\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\{Computed,On};
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

trait HandlesSortingPills
{
    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function getSortingPillsStatus(): bool
    {
        return $this->sortingConfig['sortingPillsStatus'] ?? true;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    #[Computed]
    public function getDefaultSortingLabelAsc(): string
    {
        return $this->sortingConfig['defaultSortingLabelAsc'] ?? 'A-Z';
    }


    /**
     * Undocumented function
     *
     * @return string
     */
    #[Computed]
    public function getDefaultSortingLabelDesc(): string
    {
        return $this->sortingConfig['defaultSortingLabelDesc'] ?? 'Z-A';
    }


    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getSortsForPills(): array
    {
        $sortedCols = [];
        $defaultSortingLabelAsc = $this->getDefaultSortingLabelAsc();
        $defaultSortingLabelDesc = $this->getDefaultSortingLabelDesc();
        $sortKeys = array_keys($this->sorts);
        foreach($this->getColumns()
            ->visibleSortableColumns()
            ->reject(fn (Column $column) => !in_array($column->getSlug(), $sortKeys) && !in_array($column->getTitle(), $sortKeys)) as $sortedColumn)
        {
            $columnSelectName = $sortedColumn->getSlug();
            $direction = $this->sorts[$columnSelectName];
            $sortingPillTitle = $sortedColumn->getSortingPillTitle();
            $sortingPillDirectionLabel = $sortedColumn->getSortingPillDirectionLabel($direction, $defaultSortingLabelAsc, $defaultSortingLabelDesc);

            $sortedCols[] = [
                'columnSelectName' => $columnSelectName,
                'direction' => $direction,
                'sortingPillTitle' => $sortingPillTitle,
                'sortingPillDirectionLabel' => $sortingPillDirectionLabel,
            ];
        } 
        return $sortedCols;
    }


    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function sortingPillsAreEnabled(): bool
    {
        return $this->getSortingPillsStatus() === true;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function sortingPillsAreDisabled(): bool
    {
        return $this->getSortingPillsStatus() === false;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    #[Computed]
    public function showSortPillsSection(): bool
    {
        return $this->sortingIsEnabled() && $this->sortingPillsAreEnabled() && $this->hasSorts();
    }
    
    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setSortingPillsStatus(bool $status): self
    {
        $this->sortingConfig['sortingPillsStatus'] = $status;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setSortingPillsEnabled(): self
    {
        return $this->setSortingPillsStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setSortingPillsDisabled(): self
    {
        return $this->setSortingPillsStatus(false);
    }

    /**
     * Undocumented function
     *
     * @param string $asc
     * @param string $desc
     * @return self
     */
    public function setDefaultSortingLabels(string $asc, string $desc): self
    {
        $this->sortingConfig['defaultSortingLabelAsc'] = $asc;
        $this->sortingConfig['defaultSortingLabelDesc'] = $desc;

        return $this;
    }

}