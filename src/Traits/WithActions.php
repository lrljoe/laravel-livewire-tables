<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\ActionsConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ActionsHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\HasActionsStyling;

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
     * @var Collection<int,\Rappasoft\LaravelLivewireTables\Views\Action>|null
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
