<?php

namespace Rappasoft\LaravelLivewireTables\Features\BulkActions\Core;

use Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Concerns\{HandlesConfirmation, HandlesSelectAll, HandlesSelected};
use Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Configuration\BulkActionsConfiguration;
use Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Helpers\BulkActionsHelpers;
use Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Styling\{HandlesBulkActionTableStyling, HasBulkActionsStyling};

trait WithBulkActions
{
    use BulkActionsConfiguration,
        BulkActionsHelpers,
        HandlesConfirmation,
        HandlesSelected,
        HandlesSelectAll,
        HandlesBulkActionTableStyling,
        HasBulkActionsStyling;

    /**
     * Used for historic approach for Bulk Actions
     *
     * @var array<mixed>
     */
    public array $bulkActions = [];

    /**
     * Used for historic approach for Bulk Action Confirmation Message
     *
     * @var array<mixed>
     */
    public array $bulkActionConfirms = [];

    /**
     * Selected Items
     *
     * Entangled in JS
     *
     * @var array<mixed>
     */
    public array $selected = [];

    /**
     * Used to store configuration for Bulk Actions
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
     * Current method for defining bulk actions
     *
     * @return array<mixed>
     */
    public function bulkActions(): array
    {
        return $this->bulkActions;
    }
}
