<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Action;

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
     * Undocumented function
     *
     * @return boolean
     */
    #[Computed]
    public function showActionsInToolbar(): bool
    {
        return $this->displayActionsInToolbar ?? false;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    #[Computed]
    public function getActionsPosition(): string
    {
        return $this->actionsPosition ?? 'right';
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    #[Computed]
    public function hasActions(): bool
    {
        if (! isset($this->validActions)) {
            $this->validActions = $this->getActions();
        }

        return $this->validActions->count() > 0;
    }

    /**
     * Undocumented function
     *
     * @return Collection<int,Action>
     */
    #[Computed]
    public function getActions(): Collection
    {
        if (! isset($this->validActions)) {
            $this->validActions = (new Collection($this->actions()))
                ->filter(fn ($action) => $action instanceof Action)
                ->each(function (Action $action, int $key) {
                    $action->setTheme($this->getTheme());
                });
        }

        return $this->validActions;
    }
}
