<?php

namespace Rappasoft\LaravelLivewireTables\Features\Reordering\Configuration;

trait ReorderingConfiguration
{
    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setReorderStatus(bool $status): self
    {
        $this->reorderConfig['reorderStatus'] = $status;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setReorderEnabled(): self
    {
        return $this->setReorderStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setReorderDisabled(): self
    {
        return $this->setReorderStatus(false);
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setCurrentlyReorderingStatus(bool $status): self
    {
        $this->reorderConfig['currentlyReorderingStatus'] = $status;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setCurrentlyReorderingEnabled(): self
    {
        return $this->setCurrentlyReorderingStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setCurrentlyReorderingDisabled(): self
    {
        return $this->setCurrentlyReorderingStatus(false);
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setHideReorderColumnUnlessReorderingStatus(bool $status): self
    {
        $this->reorderConfig['hideReorderColumnUnlessReorderingStatus'] = $status;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setHideReorderColumnUnlessReorderingEnabled(): self
    {
        return $this->setHideReorderColumnUnlessReorderingStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setHideReorderColumnUnlessReorderingDisabled(): self
    {
        return $this->setHideReorderColumnUnlessReorderingStatus(false);
    }

    /**
     * Undocumented function
     *
     * @param string $method
     * @return self
     */
    public function setReorderMethod(string $method): self
    {
        $this->reorderConfig['reorderMethod'] = $method;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param string $field
     * @param string $direction
     * @return self
     */
    public function setDefaultReorderSort(string $field, string $direction = 'asc'): self
    {
        $this->reorderConfig['defaultReorderColumn'] = $field;
        $this->reorderConfig['defaultReorderDirection'] = $direction;

        return $this;
    }

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
    private function resetReorderFields(): void
    {
        $this->table = [];
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


}
