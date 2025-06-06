<?php

namespace Rappasoft\LaravelLivewireTables\Features\BulkActions\Core;

use Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Configuration\BulkActionsConfiguration;
use Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Helpers\BulkActionsHelpers;
use Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Styling\HasBulkActionsStyling;

trait WithBulkActions
{
    use BulkActionsConfiguration,
        BulkActionsHelpers,
        HasBulkActionsStyling;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    //public array $bulkActions = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    //public array $bulkActionConfirms = [];

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
     * @var array<mixed>
     */
    public array $bulkActionConfig = [
        'alwaysHideBulkActionsDropdownOption' => false,
        'bulkActionConfirmDefaultMessage' => null,
        'bulkActionsStatus' => true,
        'clearSelectedOnFilter' => true,
        'clearSelectedOnSearch' => true,
        'delaySelectAll' => false,
        'hideBulkActionsWhenEmpty' => false,
        'selectAll' => false,
    ];

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
