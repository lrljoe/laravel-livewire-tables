<?php

namespace Rappasoft\LaravelLivewireTables\Features\Search;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Events\SearchApplied;
use Rappasoft\LaravelLivewireTables\Features\Search\QueryString\HasQueryStringForSearch;
use Rappasoft\LaravelLivewireTables\Features\Search\Styling\{HasSearchIcon, HasSearchInput};
use Rappasoft\LaravelLivewireTables\Features\Search\Traits\{HandlesSearchModifiers,HandlesSearchStatus, HandlesSearchTrim,HandlesSearchVisibility};

trait WithSearch
{
    use HandlesSearchStatus,
        HandlesSearchModifiers,
        HandlesSearchTrim,
        HandlesSearchVisibility,
        HasQueryStringForSearch,
        HasSearchIcon,
        HasSearchInput;

    /**
    * Undocumented variable
    *
    * @var string
    */
    public string $search = '';

    /**
     * Undocumented function
     *
     * @return Builder<\Illuminate\Database\Eloquent\Model>
     */
    public function applySearch(): Builder
    {
        if ($this->searchIsEnabled() && $this->hasSearch()) {

            $searchableColumns = $this->getSearchableColumns();
            $search = $this->getSearch();

            $this->callHook('searchUpdated', ['value' => $search]);
            $this->callTraitHook('searchUpdated', ['value' => $search]);
            if ($this->getEventStatusSearchApplied() && $search != null) {
                event(new SearchApplied($this->getTableName(), $search));
            }

            if ($searchableColumns->count()) {
                $this->setBuilder($this->getBuilder()->where(function ($query) use ($searchableColumns, $search) {
                    foreach ($searchableColumns as $index => $column) {
                        if ($column->hasSearchCallback()) {
                            ($column->getSearchCallback())($query, $search);
                        } else {
                            $query->{$index === 0 ? 'where' : 'orWhere'}($column->getColumn(), 'like', '%'.$search.'%');
                        }
                    }
                }));
            }
        }

        return $this->getBuilder();
    }

    /**
     * Undocumented function
     *
     * @param string|array<mixed>|null $value
     * @return void
     */
    public function updatedSearch(string|array|null $value): void
    {
        if ($this->shouldTrimSearchString() && $this->search != trim($value)) {
            $this->search = $value = trim($value);
        }

        $this->resetComputedPage();

        // Clear bulk actions on search - if enabled
        if ($this->getClearSelectedOnSearch()) {
            $this->clearSelected();
            $this->setSelectAllDisabled();
        }

        if (is_null($value) || $value === '') {
            $this->clearSearch();
        }
    }

    
    /**
     * hasSearch
     *
     * @return boolean
     *     #[Computed]
     */
    public function hasSearch(): bool
    {
        return $this->search != '';
    }

    /**
     * getSearch
     *  #[Computed]
     * @return string
     */
    public function getSearch(): string
    {
        if ($this->shouldTrimSearchString() && $this->search != trim($this->search)) {
            $this->search = trim($this->search);
        }

        return $this->search ?? '';
    }

    /**
     * Search the search query from the table array
     *
     * @return void
     */
     public function clearSearch(): void
    {
        $this->search = '';
    }

    /**
     * Undocumented function
     *
     * @param string $query
     * @return self
     */
    public function setSearch(string $query): self
    {
        if ($this->shouldTrimSearchString()) {
            $this->search = trim($query);
        } else {
            $this->search = $query;
        }

        return $this;
    }
}
