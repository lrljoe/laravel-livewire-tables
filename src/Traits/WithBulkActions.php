<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\BulkActionsConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\BulkActionsHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\HasBulkActionsStyling;

trait WithBulkActions
{
    use BulkActionsConfiguration,
        BulkActionsHelpers,
        HasBulkActionsStyling;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    public bool $bulkActionsStatus = true;

    /**
     * Undocumented variable
     *
     * Entangled in JS
     * 
     * @var boolean
     */
    public bool $selectAll = false;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $bulkActions = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $bulkActionConfirms = [];

    /**
     * Undocumented variable
     * 
     * Entangled in JS
     * 
     * @var array<mixed>
     */
    public array $selected = [];

    /**
     * Undocumented variable
     *
     * Entangled in JS
     * 
     * @var boolean
     */
    public bool $hideBulkActionsWhenEmpty = false;

    /**
     * Undocumented variable
     *
     * @var string|null
     */
    public ?string $bulkActionConfirmDefaultMessage;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $alwaysHideBulkActionsDropdownOption = false;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $clearSelectedOnSearch = true;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $clearSelectedOnFilter = true;

    /**
     * Undocumented variable
     *
     * Entangled in JS
     * 
     * @var boolean
     */
    public bool $delaySelectAll = false;

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function bulkActions(): array
    {
        return $this->bulkActions;
    }
}
