<?php

namespace Rappasoft\LaravelLivewireTables\Features\Sorting\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\{Computed,On};

trait SortingHelpers
{
    /**
     * Undocumented function
     */
    public function getSortingStatus(): bool
    {
        return $this->sortingConfig['sortingStatus'] ?? true;
    }

    /**
     * Undocumented function
     */
    public function getSingleSortingStatus(): bool
    {
        return $this->sortingConfig['singleColumnSortingStatus'] ?? true;
    }

    /**
     * Undocumented function
     */
    public function getDefaultSortColumn(): ?string
    {
        return $this->sortingConfig['defaultSortColumn'];
    }

    /**
     * Undocumented function
     */
    public function getDefaultSortDirection(): string
    {
        return $this->sortingConfig['defaultSortDirection'] ?? 'asc';
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getSorts(): array
    {
        foreach ($this->sorts as $column => $direction) {
            if (is_array($direction)) {
                foreach ($direction as $colAppend => $actualDirection) {
                    $this->sorts[$column.'.'.$colAppend] = $actualDirection;
                    $this->clearSort($column);
                }
            }

        }

        return $this->sorts;
    }

    /**
     * @param  array<mixed>  $sorts
     * @return array<mixed>
     */
    public function setSorts(array $sorts = []): array
    {

        return $this->sorts = collect($sorts)
            ->reject(fn ($dir, $column) => ! in_array($column, $this->getSortableColumns()->toArray(), true))
            ->toArray();
    }

    /**
     * Undocumented function
     */
    public function getSort(string $field): ?string
    {
        return $this->sorts[$field] ?? null;
    }

    /**
     * Undocumented function
     */
    #[On('setSort')]
    #[On('set-sort')]
    public function setSort(string $field, string $direction): string
    {
        return $this->sorts[$field] = $direction;
    }

    /**
     * Undocumented function
     */
    public function hasSorts(): bool
    {
        return count($this->getSorts()) > 0;
    }

    /**
     * Undocumented function
     */
    public function hasSort(string $field): bool
    {
        return $this->getSort($field) !== null;
    }

    /**
     * Clear the sorts array
     */
    #[On('clearSorts')]
    #[On('clearsorts')]
    public function clearSorts(): void
    {
        $this->sorts = [];
    }

    /**
     * Clear an individual sort
     */
    public function clearSort(string $field): void
    {
        unset($this->sorts[$field]);
    }

    /**
     * Undocumented function
     */
    public function setSortAsc(string $field): string
    {
        return $this->setSort($field, 'asc');
    }

    /**
     * Undocumented function
     */
    public function setSortDesc(string $field): string
    {
        return $this->setSort($field, 'desc');
    }

    /**
     * Undocumented function
     */
    public function isSortAsc(string $field): bool
    {
        return $this->getSort($field) === 'asc';
    }

    /**
     * Undocumented function
     */
    public function isSortDesc(string $field): bool
    {
        return $this->getSort($field) === 'desc';
    }

    /**
     * Undocumented function
     */
    public function sortingIsEnabled(): bool
    {
        return $this->getSortingStatus() === true;
    }

    /**
     * Undocumented function
     */
    public function sortingIsDisabled(): bool
    {
        return $this->getSortingStatus() === false;
    }

    /**
     * Undocumented function
     */
    public function singleSortingIsEnabled(): bool
    {
        return $this->getSingleSortingStatus() === true;
    }

    /**
     * Undocumented function
     */
    public function singleSortingIsDisabled(): bool
    {
        return $this->getSingleSortingStatus() === false;
    }

    /**
     * Undocumented function
     */
    public function hasDefaultSort(): bool
    {
        return $this->getDefaultSortColumn() !== null;
    }

    /**
     * Undocumented function
     */
    public function sortBy(string $columnSelectName): ?string
    {

        if ($this->sortingIsDisabled()) {
            return null;
        }

        // If single sorting is enabled and there are sorts but not the field that is being sorted,
        // then clear all the sorts
        if ($this->singleSortingIsEnabled() && $this->hasSorts() && ! $this->hasSort($columnSelectName)) {
            $this->clearSorts();
            $this->resetComputedPage();

        }

        if (! $this->hasSort($columnSelectName)) {
            $this->resetComputedPage();

            return $this->setSortAsc($columnSelectName);
        }

        if ($this->isSortAsc($columnSelectName)) {
            $this->resetComputedPage();

            return $this->setSortDesc($columnSelectName);
        }

        $this->clearSort($columnSelectName);

        return null;
    }

    /**
     * Undocumented function
     *
     * @return Builder<\Illuminate\Database\Eloquent\Model>
     */
    public function applySorting(): Builder
    {

        $allCols = $this->getColumns()
            ->visibleSortableColumnsKeyed(array_keys($this->sorts));

        $sorts = $this->getSorts();

        foreach ($allCols as $columnSelectName => $column) {

            $direction = $sorts[$columnSelectName];
            if (! in_array($direction, ['asc', 'desc'])) {
                $direction = 'asc';
            }

            if (! $column->isSortable() && ! $column->hasSortCallback()) {
                continue;
            }

            // TODO: Test
            if ($column->hasSortCallback()) {
                $this->setBuilder(call_user_func($column->getSortCallback(), $this->getBuilder(), $direction));
            } elseif ($column->isBaseColumn()) {
                $this->setBuilder($this->getBuilder()->orderBy($column->getColumnSelectName(), $direction));
            } else {
                $value = $this->getBuilder()->getGrammar()->wrap($column->getColumn().' as '.$column->getColumnSelectName());
                $segments = preg_split('/\s+as\s+/i', $value);
                if (array_key_exists(1, $segments)) {
                    $this->setBuilder($this->getBuilder()->orderByRaw($segments[1].' '.$direction));
                }
            }
        }

        return $this->getBuilder();
    }
}
