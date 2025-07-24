<?php

namespace Rappasoft\LaravelLivewireTables\Features\Actions\Core\Helpers;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Features\Actions\Views\Action;
use Rappasoft\LaravelLivewireTables\Collections\ActionCollection;

trait ActionsHelpers
{
    /**
     * Undocumented function
     *
     * @return boolean
     */
    #[Computed]
    public function showActionsInToolbarLeft(): bool
    {
        return $this->hasActions() && $this->showActionsInToolbar() && $this->getActionsPosition() === 'left';
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    #[Computed]
    public function showActionsInToolbarRight(): bool
    {
        return $this->hasActions() && $this->showActionsInToolbar() && $this->getActionsPosition() === 'right';
    }

    /**
     * Determines whether to display the Actions in the Toolbar
     *
     * @return boolean
     */
    #[Computed]
    public function showActionsInToolbar(): bool
    {
        return $this->displayActionsInToolbar ?? false;
    }

    /**
     * Determines whether to display the Actions in a Dropdown in the Toolbar by default
     *
     * @return boolean
     */
    #[Computed]
    public function showActionsAsDropdown(): bool
    {
        return $this->displayActionsAsDropdown ?? false;
    }
    /**
     * Retrieves the position of the Actions (e.g. left/right)
     *
     * @return string
     */
    #[Computed]
    public function getActionsPosition(): string
    {
        return $this->actionsPosition ?? 'right';
    }

    /**
     * Returns whether there are any valid actions
     *
     * @return boolean
     */
    #[Computed]
    public function hasActions(): bool
    {
        if (! isset($this->validActions) || empty($this->validActions)) {
            $this->validActions = $this->getActions();
        }

        return $this->validActions->count() > 0;
    }

    /**
     * Retrieves the valid actions
     *
     * @return ActionCollection<int,Action>
     */
    #[Computed]
    public function getActions(): ActionCollection
    {
        return (new ActionCollection($this->actions()))
                ->filter(fn ($action) => $action instanceof Action)
                ->each(function (Action $action, int $key) {
                    $action->setTheme($this->getTheme());
                });

    }
}
