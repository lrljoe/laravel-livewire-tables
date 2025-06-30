<?php

namespace Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Concerns;


trait HandlesConfirmation
{
    
    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getBulkActionConfirms(): array
    {
        return array_keys($this->bulkActionConfirms);
    }

    /**
     * Undocumented function
     *
     * @param string $bulkAction
     * @return boolean
     */
    public function hasConfirmationMessage(string $bulkAction): bool
    {
        return isset($this->bulkActionConfirms[$bulkAction]);
    }
    
    public function hasBulkActionConfirmMessage(string $bulkAction): bool
    {
        return isset($this->bulkActionConfirms[$bulkAction]);
    }

    /**
     * Undocumented function
     *
     * @param string $bulkAction
     * @return string
     */
    public function getBulkActionConfirmMessage(string $bulkAction): string
    {
        return $this->bulkActionConfirms[$bulkAction] ?? $this->getBulkActionDefaultConfirmationMessage();
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getBulkActionDefaultConfirmationMessage(): string
    {
        return isset($this->bulkActionConfig['bulkActionConfirmDefaultMessage']) ? $this->bulkActionConfig['bulkActionConfirmDefaultMessage'] : __($this->getLocalisationPath().'Bulk Actions Confirm');
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

    /**
     * Undocumented function
     *
     * @param string $action
     * @param string $confirmationMessage
     * @return self
     */
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

    /**
     * Undocumented function
     *
     * @param string $defaultConfirmationMessage
     * @return self
     */
    public function setBulkActionDefaultConfirmationMessage(string $defaultConfirmationMessage): self
    {
        $this->setBulkActionConfig('bulkActionConfirmDefaultMessage', $defaultConfirmationMessage);

        return $this;
    }
}