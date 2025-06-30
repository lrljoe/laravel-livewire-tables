<?php

namespace Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Configuration;

trait BulkActionsConfiguration
{
    /**
     * @param  array<mixed>  $bulkActions
     */
    public function setBulkActions(array $bulkActions): self
    {
        $this->bulkActions = $bulkActions;

        return $this;
    }

    public function setBulkActionsStatus(bool $status): self
    {
        $this->setBulkActionConfig('bulkActionsStatus', $status);

        return $this;
    }

    public function setBulkActionsEnabled(): self
    {
        $this->setBulkActionsStatus(true);

        return $this;
    }

    public function setBulkActionsDisabled(): self
    {
        $this->setBulkActionsStatus(false);

        return $this;
    }


    public function setHideBulkActionsWhenEmptyStatus(bool $status): self
    {
        $this->setBulkActionConfig('hideBulkActionsWhenEmpty', $status);

        return $this;
    }

    public function setHideBulkActionsWhenEmptyEnabled(): self
    {
        $this->setHideBulkActionsWhenEmptyStatus(true);

        return $this;
    }

    public function setHideBulkActionsWhenEmptyDisabled(): self
    {
        $this->setHideBulkActionsWhenEmptyStatus(false);

        return $this;
    }


    public function setShouldAlwaysHideBulkActionsDropdownOption(bool $status = false): self
    {
        $this->setBulkActionConfig('alwaysHideBulkActionsDropdownOption', $status);

        return $this;
    }

    public function setShouldAlwaysHideBulkActionsDropdownOptionEnabled(): self
    {
        return $this->setShouldAlwaysHideBulkActionsDropdownOption(true);
    }

    public function setShouldAlwaysHideBulkActionsDropdownOptionDisabled(): self
    {
        return $this->setShouldAlwaysHideBulkActionsDropdownOption(false);
    }

    public function setClearSelectedOnSearch(bool $status): self
    {
        $this->setBulkActionConfig('clearSelectedOnSearch', $status);

        return $this;
    }

    public function setClearSelectedOnSearchEnabled(): self
    {
        return $this->setClearSelectedOnSearch(true);
    }

    public function setClearSelectedOnSearchDisabled(): self
    {
        return $this->setClearSelectedOnSearch(false);

    }

    public function setClearSelectedOnFilter(bool $status): self
    {
        $this->setBulkActionConfig('clearSelectedOnFilter', $status);

        return $this;
    }

    public function setClearSelectedOnFilterEnabled(): self
    {
        return $this->setClearSelectedOnFilter(true);
    }

    public function setClearSelectedOnFilterDisabled(): self
    {
        return $this->setClearSelectedOnFilter(false);
    }

    protected function setBulkActionConfig(string $key, bool $value): self
    {
        $this->bulkActionConfig[$key] = $value;

        return $this;
    }
}
