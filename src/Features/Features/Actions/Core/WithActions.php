<?php

namespace Rappasoft\LaravelLivewireTables\Features\Actions\Core;

use Rappasoft\LaravelLivewireTables\Collections\ActionCollection;
use Rappasoft\LaravelLivewireTables\Features\Actions\Core\Configuration\ActionsConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Actions\Core\Helpers\ActionsHelpers;
use Rappasoft\LaravelLivewireTables\Features\Actions\Core\Styling\HasActionsStyling;

trait WithActions
{
    use ActionsConfiguration,
        ActionsHelpers,
        HasActionsStyling;

    /**
     * Undocumented variable
     */
    protected bool $displayActionsInToolbar = false;

    /**
     * Undocumented variable
     */
    protected bool $displayActionsAsDropdown = false;

    /**
     * Undocumented variable
     */
    protected string $actionsPosition = 'right';

    /**
     * Undocumented variable
     *
     * @var ActionCollection<int,\Rappasoft\LaravelLivewireTables\Features\Actions\Views\Action>|null
     */
    protected ?ActionCollection $validActions;

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function actions(): array
    {
        return [];
    }
}
