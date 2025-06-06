<?php

namespace Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Helpers;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;
use Rappasoft\LaravelLivewireTables\Features\BulkActions\Views\BulkAction;

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

    public function getSelectAllStatus(): bool
    {
        return $this->getBulkActionConfig('selectAll');
    }

    public function selectAllIsEnabled(): bool
    {
        return $this->getSelectAllStatus() === true;
    }

    public function selectAllIsDisabled(): bool
    {
        return $this->getSelectAllStatus() === false;
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
        return $this->bulkActions();
    }


    /**
     * @return array<int,BulkAction>
     */
    public function getBulkActionsButtons(): array
    {
        $bulkActions = [];
        $defaultAttributes = $this->getBulkActionsMenuItemAttributes();
        foreach($this->getBulkActions() as $action => $title)
        {
            if($title instanceof BulkAction)
            {
                if(!$title->hasButtonAttributes())
                {
                    $title->setButtonAttributes($defaultAttributes);
                }
                $bulkActions[] = $title;
            }
            else
            {
                $bulkActions[] = BulkAction::make(action: $action, title: $title)->setButtonAttributes($defaultAttributes);
            }
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
     * @param  array<mixed>  $selected
     * @return array<mixed>
     */
    public function setSelected(array $selected): array
    {
        return $this->selected = $selected;
    }

    /**
     * @return array<mixed>
     */
    public function getSelected(): array
    {
        return $this->selected;
    }

    public function hasSelected(): bool
    {
        return $this->getSelectedCount() > 0;
    }

    public function getSelectedCount(): int
    {
        return count($this->getSelected());
    }

    /**
     * Clear the bulk selected and disable select all
     */
    public function clearSelected(): void
    {
        $this->setSelectAllDisabled();
        $this->setSelected([]);
    }

    /**
     * Disable select all when the selected array is updated - if DelaySelectAll is not enabled
     */
    public function updatedSelected(): void
    {
        if (! $this->getDelaySelectAllStatus()) {
            $this->setSelectAllDisabled();
        }
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

    /**
     * Set select all and get all ids for selected
     */
    public function setAllSelected(): void
    {
        $this->setSelectAllEnabled();
        $this->setSelected((clone $this->baseQuery())->pluck($this->getBuilder()->getModel()->getTable().'.'.$this->getPrimaryKey())->map(fn ($item) => (string) $item)->toArray());
    }

    public function showBulkActionsDropdownAlpine(): bool
    {
        return $this->bulkActionsAreEnabled() && $this->hasBulkActions();
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getBulkActionConfirms(): array
    {
        return array_keys($this->bulkActionConfirms);
    }

    public function hasConfirmationMessage(string $bulkAction): bool
    {
        return isset($this->bulkActionConfirms[$bulkAction]);
    }

    public function getBulkActionConfirmMessage(string $bulkAction): string
    {
        return $this->bulkActionConfirms[$bulkAction] ?? $this->getBulkActionDefaultConfirmationMessage();
    }

    public function getBulkActionDefaultConfirmationMessage(): string
    {
        return isset($this->bulkActionConfig['bulkActionConfirmDefaultMessage']) ? $this->bulkActionConfig['bulkActionConfirmDefaultMessage'] : __($this->getLocalisationPath().'Bulk Actions Confirm');
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
            return (clone $this->baseQuery())->select($this->getBuilder()->getModel()->getTable().'.'.$this->getPrimaryKey())->pluck($this->getBuilder()->getModel()->getTable().'.'.$this->getPrimaryKey())->map(fn ($item) => $item)->toArray();
        } else {
            return $this->selected;
        }
    }

    public function getDelaySelectAllStatus(): bool
    {
        return $this->bulkActionConfig['delaySelectAll'] ?? false;
    }

    /**
     * Undocumented function
     *
     * @return Column
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
