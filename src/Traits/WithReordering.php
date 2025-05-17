<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\ReorderingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ReorderingHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\HasReorderStyling;

trait WithReordering
{
    use ReorderingConfiguration,
        ReorderingHelpers,
        HasReorderStyling;

    /**
     * Undocumented variable
     * 
     * Entangled in JS
     *
     * @var boolean
     */
    public bool $reorderStatus = false;

    /**
     * Undocumented variable
     * 
     * Entangled in JS
     *
     * @var boolean
     */
    public bool $currentlyReorderingStatus = false;

    /**
     * Undocumented variable
     * 
     * Entangled in JS
     *
     * @var boolean
     */
    public bool $hideReorderColumnUnlessReorderingStatus = false;

    /**
     * Undocumented variable
     * 
     * Entangled in JS
     *
     * @var boolean
     */
    public bool $reorderDisplayColumn = false;

    /**
     * Undocumented variable
     * 
     * Retrieved in JS
     *
     * @var string
     */
    public string $defaultReorderColumn = 'sort';

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $orderedItems = [];

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $reorderMethod = 'reorder';

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $defaultReorderDirection = 'asc';

    /**
     * Undocumented function
     *
     * @return void
     */
    public function setupReordering(): void
    {
        if ($this->reorderIsDisabled()) {
            return;
        }

        // If reordering is disabled but the page has a reorder session, remove it
        if (! $this->reorderIsEnabled() && $this->hasReorderingSession()) {
            $this->forgetReorderingSession();
        }

        $this->restartReorderingIfNecessary();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function enablePaginatedReordering(): void {}

    /**
     * Undocumented function
     *
     * @return void
     */
    public function enableReordering(): void
    {
        $this->setReorderingSession();
        $this->setReorderingBackup();
        $this->resetReorderFields();
        $this->reorderStatus = $this->currentlyReorderingStatus = $this->reorderDisplayColumn = true;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function disableReordering(): void
    {

        $this->forgetReorderingSession();
        $this->setCurrentlyReorderingDisabled();
        $this->getReorderingBackup();
        $this->currentlyReorderingStatus = $this->reorderDisplayColumn = false;

    }

    /**
     * Undocumented function
     *
     * @return void
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
     * @return void
     */
    private function resetReorderFields(): void
    {
        $this->{$this->getTableName()} = [];
        $this->setSortingPillsDisabled();
        $this->setSortingDisabled();
        $this->setPaginationDisabled();
        $this->setPerPageVisibilityDisabled();
        $this->setPerPageAccepted([-1]);
        $this->setPerPage(-1);
        $this->setSearchDisabled();
        $this->setBulkActionsDisabled();
        $this->clearSelected();
        $this->setFiltersDisabled();
        $this->setSecondaryHeaderDisabled();
        $this->setFooterDisabled();
        $this->setCollapsingColumnsDisabled();
        $this->resetComputedPage();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function setReorderingBackup(): void
    {
        if (session()->has($this->getReorderingBackupSessionKey())) {
            session()->forget($this->getReorderingBackupSessionKey());
        }
        session([$this->getReorderingBackupSessionKey() => $this->getTableStateToArray()]);
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function getTableStateToArray(): array
    {
        return [
            $this->getTableName() => $this->{$this->getTableName()},
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
        ];
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $tableState
     * @return void
     */
    protected function restoreStateFromArray(array $tableState): void
    {
        $this->{$this->getTableName()} = $tableState[$this->getTableName()];
        $this->sorts = $tableState['sorts'];
        $this->search = $tableState['search'];
        $this->selectedColumns = $tableState['selectedColumns'];
        $this->setSortingPillsStatus($tableState['sortingPillsStatus']);
        $this->setSortingStatus($tableState['sortingStatus']);
        $this->setPaginationStatus($tableState['paginationStatus']);
        $this->setPerPageVisibilityStatus($tableState['perPageVisibilityStatus']);
        $this->setPerPageAccepted($tableState['perPageAccepted']);
        $this->setPerPage($tableState['perPage']);
        $this->setPage($tableState['page'], $this->getComputedPageName());
        $this->setSearchStatus($tableState['searchStatus']);
        $this->setBulkActionsStatus($tableState['bulkActionsStatus']);
        $this->setSelected($tableState['selected']);
        $this->setSelectAllStatus($tableState['selectAllStatus']);
        $this->setFiltersStatus($tableState['filtersStatus']);
        $this->setSecondaryHeaderStatus($tableState['secondaryHeaderStatus']);
        $this->setFooterStatus($tableState['footerStatus']);
        $this->setCollapsingColumnsStatus($tableState['collapsingColumnsStatus']);

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function getReorderingBackup(): void
    {
        // TODO: Why won't secondary header and footer come back?
        if (session()->has($this->getReorderingBackupSessionKey())) {
            $this->restoreStateFromArray(session()->get($this->getReorderingBackupSessionKey()));
            session()->forget($this->getReorderingBackupSessionKey());
        }
        $this->currentlyReorderingStatus = $this->reorderDisplayColumn = false;

    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $rows
     * @return void
     */
    public function storeReorder(array $rows = []): void
    {
        $this->{$this->getReorderMethod()}($rows);
        $this->forgetReorderingSession();
        $this->getReorderingBackup();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function renderingWithReordering(): void
    {
        $this->setupReordering();
    }
}
