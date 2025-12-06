<?php

namespace Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Helpers;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Features\BulkActions\Views\BulkAction;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

trait BulkActionsHelpers
{
    #[Computed]
    public function showBulkActionsSections(): bool
    {
        return $this->bulkActionsAreEnabled() && $this->hasBulkActions();
    }

    public function getBulkActionsStatus(): bool
    {
        return $this->getBulkActionConfig('bulkActionsStatus');
    }

    public function bulkActionsAreEnabled(): bool
    {
        return $this->getBulkActionsStatus() === true;
    }

    public function bulkActionsAreDisabled(): bool
    {
        return $this->getBulkActionsStatus() === false;
    }

    public function getHideBulkActionsWhenEmptyStatus(): bool
    {
        return $this->getBulkActionConfig('hideBulkActionsWhenEmpty');
    }

    public function hideBulkActionsWhenEmptyIsEnabled(): bool
    {
        return $this->getHideBulkActionsWhenEmptyStatus() === true;
    }

    public function hideBulkActionsWhenEmptyIsDisabled(): bool
    {
        return $this->getHideBulkActionsWhenEmptyStatus() === false;
    }

    public function hasBulkActions(): bool
    {
        return count($this->bulkActions()) > 0;
    }

    /**
     * @return array<mixed>
     */
    public function getBulkActions(): array
    {
        return ! empty($this->bulkActions) ? $this->bulkActions : $this->bulkActions();
    }

    /**
     * @return array<int,BulkAction>
     */
    public function getBulkActionsButtons(): array
    {
        $bulkActions = [];
        $defaultAttributes = $this->getBulkActionsMenuItemAttributes();
        foreach ($this->getBulkActions() as $action => $title) {
            if ($title instanceof BulkAction) {
                $bulkAction = $title;
                $action = $bulkAction->getAction();

                // Set default attributes if not defined on BulkAction
                if (! $bulkAction->hasButtonAttributes()) {
                    $bulkAction->setButtonAttributes($defaultAttributes);
                }
            } else {
                // Create a BulkAction instance
                $bulkAction = BulkAction::make(action: $action, title: $title)
                    ->setButtonAttributes($defaultAttributes);

            }

            // Check if it should display a confirmation message
            if (! empty($this->bulkActionConfirms) && ! $bulkAction->hasConfirmationMessage() && $this->hasBulkActionConfirmMessage($action)) {
                $bulkAction->setConfirmationMessage($this->getBulkActionConfirmMessage($action));
            }

            // Add to array
            $bulkActions[] = $bulkAction;

        }

        return $bulkActions;
    }

    public function showBulkActionsDropdown(): bool
    {
        $show = false;

        if ($this->bulkActionsAreEnabled()) {
            if ($this->hasBulkActions()) {
                $show = true;
            }

            if ($this->hideBulkActionsWhenEmptyIsEnabled()) {
                if ($this->hasSelected()) {
                    $show = true;
                } else {
                    $show = false;
                }
            }
        }

        return $show;
    }

    /**
     * Clear or select all depending on what's selected when select all is changed
     */
    /*public function updatedSelectAll(): void
    {
        if (count($this->getSelected()) === (clone $this->baseQuery())->pluck($this->getPrimaryKey())->count()) {
            $this->clearSelected();
        } else {
            $this->setAllSelected();
        }
    }*/

    public function showBulkActionsDropdownAlpine(): bool
    {
        return $this->bulkActionsAreEnabled() && $this->hasBulkActions();
    }

    #[Computed]
    public function shouldAlwaysHideBulkActionsDropdownOption(): bool
    {
        return $this->bulkActionConfig['alwaysHideBulkActionsDropdownOption'] ?? false;
    }

    public function getClearSelectedOnSearch(): bool
    {
        return $this->bulkActionConfig['clearSelectedOnSearch'] ?? true;
    }

    public function getClearSelectedOnFilter(): bool
    {
        return $this->bulkActionConfig['clearSelectedOnFilter'] ?? true;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getSelectedRows(): array
    {
        if ($this->getDelaySelectAllStatus() && $this->selectAllIsEnabled()) {
            return (clone $this->selectAllQuery())->select($this->getBuilder()->getModel()->getTable().'.'.$this->getPrimaryKey())->pluck($this->getBuilder()->getModel()->getTable().'.'.$this->getPrimaryKey())->toArray();
        } else {
            return $this->selected;
        }
    }

    /**
     * Undocumented function
     */
    public function getBulkActionsColumn(): Column
    {
        return Column::make('bulkactions')->label(fn () => null);
    }

    protected function getBulkActionConfig(string $key): bool
    {
        return $this->bulkActionConfig[$key] ?? true;
    }
}
