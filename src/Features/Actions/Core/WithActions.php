<?php

namespace Rappasoft\LaravelLivewireTables\Features\Actions\Core;

use Illuminate\Support\Collection;
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
     *
     * @var boolean
     */
    protected bool $displayActionsInToolbar = false;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $displayActionsAsDropdown = false;

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $actionsPosition = 'right';

    /**
     * Undocumented variable
     *
     * @var Collection<int,\Rappasoft\LaravelLivewireTables\Features\Actions\Views\Action>|null
     */
    protected ?Collection $validActions;

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
