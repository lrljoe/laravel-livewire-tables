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
       // $this->bulkActionsStatus = $status;
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

    public function setSelectAllStatus(bool $status): self
    {
        //$this->selectAll = $status;
        $this->setBulkActionConfig('selectAll', $status);

        return $this;
    }

    public function setSelectAllEnabled(): self
    {
        $this->setSelectAllStatus(true);

        return $this;
    }

    public function setSelectAllDisabled(): self
    {
        $this->setSelectAllStatus(false);

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

    /**
     * Undocumented function
     *
     * @param array<mixed> $bulkActionConfirms
     * @return self
     */
    public function setBulkActionConfirms(array $bulkActionConfirms): self
    {
        foreach ($bulkActionConfirms as $bulkAction) {
            if (! $this->hasConfirmationMessage($bulkAction)) {
                $this->setBulkActionConfirmMessage($bulkAction, $this->getBulkActionDefaultConfirmationMessage());
            }
        }

        return $this;
    }

    public function setBulkActionConfirmMessage(string $action, string $confirmationMessage): self
    {
        $this->bulkActionConfirms[$action] = $confirmationMessage;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $bulkActionMessages
     * @return self
     */
    public function setBulkActionConfirmMessages(array $bulkActionMessages): self
    {
        foreach ($bulkActionMessages as $bulkAction => $confirmationMessage) {
            $this->setBulkActionConfirmMessage($bulkAction, $confirmationMessage);
        }

        return $this;
    }

    public function setBulkActionDefaultConfirmationMessage(string $defaultConfirmationMessage): self
    {
        $this->setBulkActionConfig('bulkActionConfirmDefaultMessage', $defaultConfirmationMessage);

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

    public function setDelaySelectAllStatus(bool $status): self
    {
        return $this->setBulkActionConfig('delaySelectAll', $status);
    }

    public function setDelaySelectAllEnabled(): self
    {
        return $this->setDelaySelectAllStatus(true);
    }

    public function setDelaySelectAllDisabled(): self
    {
       return $this->setDelaySelectAllStatus(false);
    }

    protected function setBulkActionConfig(string $key, bool $value): self
    {
        $this->bulkActionConfig[$key] = $value;

        return $this;
    }
}
