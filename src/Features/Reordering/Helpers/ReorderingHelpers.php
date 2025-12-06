<?php

namespace Rappasoft\LaravelLivewireTables\Features\Reordering\Helpers;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

trait ReorderingHelpers
{
    protected function getReorderConfigValue(string $key): mixed
    {
        return $this->reorderConfig[$key] ?? $this->reorderDefaultConfig[$key];
    }

    public function getReorderMethod(): string
    {
        return $this->getReorderConfigValue('reorderMethod');
    }

    public function getReorderStatus(): bool
    {
        return $this->getReorderConfigValue('reorderStatus');
    }

    #[Computed]
    public function showReorderButton(): bool
    {
        return $this->getReorderStatus() === true;
    }

    #[Computed]
    public function reorderIsEnabled(): bool
    {
        return $this->getReorderStatus() === true;
    }

    public function reorderIsDisabled(): bool
    {
        return $this->getReorderStatus() === false;
    }

    #[Computed]
    public function getCurrentlyReorderingStatus(): bool
    {
        return $this->getReorderConfigValue('currentlyReorderingStatus');
    }

    public function currentlyReorderingIsEnabled(): bool
    {
        return $this->getCurrentlyReorderingStatus() === true;
    }

    public function currentlyReorderingIsDisabled(): bool
    {
        return $this->getCurrentlyReorderingStatus() === false;
    }

    public function getHideReorderColumnUnlessReorderingStatus(): bool
    {
        return $this->getReorderConfigValue('hideReorderColumnUnlessReorderingStatus');

    }

    public function hideReorderColumnUnlessReorderingIsEnabled(): bool
    {
        return $this->getHideReorderColumnUnlessReorderingStatus() === true;
    }

    public function hideReorderColumnUnlessReorderingIsDisabled(): bool
    {
        return $this->getHideReorderColumnUnlessReorderingStatus() === false;
    }

    public function getDefaultReorderColumn(): ?string
    {
        return $this->getReorderConfigValue('defaultReorderColumn');
    }

    public function getDefaultReorderDirection(): string
    {
        return $this->getReorderConfigValue('defaultReorderDirection');
    }

    public function setReorderingSession(): void
    {
        session([$this->getReorderingSessionKey() => true]);
    }

    public function forgetReorderingSession(): void
    {
        session()->forget($this->getReorderingSessionKey());
    }

    public function hasReorderingSession(): bool
    {
        return session()->has($this->getReorderingSessionKey());
    }

    public function getReorderingSessionKey(): string
    {
        return $this->getTableName().'-reordering';
    }

    public function getReorderingBackupSessionKey(): string
    {
        return $this->getTableName().'-reordering-backup';
    }

    public function getReorderColumn(): Column
    {
        return Column::make('reorder')->label(fn () => null);
    }

    /**
     * Undocumented function
     */
    public function enableReordering(): void
    {
        $this->setReorderingSession();
        $this->setReorderingBackup();
        $this->resetReorderFields();
        $this->reorderConfig['reorderStatus'] = $this->reorderConfig['currentlyReorderingStatus'] = $this->reorderConfig['reorderDisplayColumn'] = true;
    }

    /**
     * Undocumented function
     */
    public function disableReordering(): void
    {

        $this->forgetReorderingSession();
        $this->setCurrentlyReorderingDisabled();
        $this->getReorderingBackup();
        $this->reorderConfig['currentlyReorderingStatus'] = $this->reorderConfig['reorderDisplayColumn'] = false;

    }

    /**
     * Undocumented function
     */
    private function restartReorderingIfNecessary(): void
    {
        // If the page loads with the session, enable reordering
        // Also called in ComponentUtilities@hydrate
        if ($this->reorderIsEnabled() && $this->hasReorderingSession()) {
            $this->setCurrentlyReorderingEnabled();
            $this->resetReorderFields();
        }
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function getTableStateToArray(): array
    {
        return [
            $this->getTableName() => property_exists($this, $this->getTableName()) ? $this->{$this->getTableName()} : [],
            'sorts' => $this->sorts,
            'search' => $this->search,
            'selectedColumns' => $this->selectedColumns,
            'sortingPillsStatus' => $this->getSortingPillsStatus(),
            'sortingStatus' => $this->getSortingStatus(),
            'paginationStatus' => $this->getPaginationStatus(),
            'perPageVisibilityStatus' => $this->getPerPageVisibilityStatus(),
            'perPageAccepted' => $this->getPerPageAccepted(),
            'perPage' => $this->getPerPage(),
            'page' => $this->paginators[$this->getComputedPageName()] ?? 1,
            'searchStatus' => $this->getSearchStatus(),
            'bulkActionsStatus' => $this->getBulkActionsStatus(),
            'selected' => $this->getSelected(),
            'selectAllStatus' => $this->getSelectAllStatus(),
            'filtersStatus' => $this->getFiltersStatus(),
            'secondaryHeaderStatus' => $this->getSecondaryHeaderStatus(),
            'footerStatus' => $this->getFooterStatus(),
            'collapsingColumnsStatus' => $this->hasCollapsingColumns(),
            'appliedFilters' => $this->appliedFilters,
        ];
    }

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $tableState
     */
    protected function restoreStateFromArray(array $tableState): void
    {
        if (property_exists($this, $this->getTableName())) {
            $this->{$this->getTableName()} = $tableState[$this->getTableName()];
        }
        $this->sorts = $tableState['sorts'];
        $this->search = $tableState['search'];
        $this->selectedColumns = $tableState['selectedColumns'];

        $this->setSortingPillsStatus($tableState['sortingPillsStatus']);
        $this->setSortingStatus($tableState['sortingStatus']);

        $this->restorePaginationConfig(
            $tableState['paginationStatus'],
            $tableState['perPageVisibilityStatus'],
            $tableState['perPageAccepted'],
            $tableState['perPage'],
            $tableState['page'],
        );

        $this->setSearchStatus($tableState['searchStatus']);
        $this->setBulkActionsStatus($tableState['bulkActionsStatus']);
        $this->setSelected($tableState['selected']);
        $this->setSelectAllStatus($tableState['selectAllStatus']);
        $this->setFiltersStatus($tableState['filtersStatus']);
        $this->setSecondaryHeaderStatus($tableState['secondaryHeaderStatus']);
        $this->setFooterStatus($tableState['footerStatus']);
        $this->setCollapsingColumnsStatus($tableState['collapsingColumnsStatus']);
        $this->appliedFilters = $tableState['appliedFilters'] ?? [];

    }

    /**
     * Undocumented function
     */
    private function getReorderingBackup(): void
    {
        // TODO: Why won't secondary header and footer come back?
        if (session()->has($this->getReorderingBackupSessionKey())) {
            $this->restoreStateFromArray(session()->get($this->getReorderingBackupSessionKey()));
            session()->forget($this->getReorderingBackupSessionKey());
        }
        $this->reorderConfig['currentlyReorderingStatus'] = $this->reorderConfig['reorderDisplayColumn'] = false;

    }

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $rows
     */
    public function storeReorder(array $rows = []): void
    {
        $this->{$this->getReorderMethod()}($rows);
        $this->forgetReorderingSession();
        $this->getReorderingBackup();
    }
}
