<?php

namespace Rappasoft\LaravelLivewireTables\Features\Reordering;

use Rappasoft\LaravelLivewireTables\Features\Reordering\Configuration\ReorderingConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Reordering\Helpers\ReorderingHelpers;
use Rappasoft\LaravelLivewireTables\Features\Reordering\Styling\HasReorderStyling;

trait WithReordering
{
    use ReorderingConfiguration,
        ReorderingHelpers,
        HasReorderStyling;

    /**
     * Undocumented variable
     *
     * Entangled in JS
     *
     * @var bool
     */
    // public bool $reorderStatus = false;

    /**
     * Undocumented variable
     *
     * Entangled in JS
     *
     * @var bool
     */
    // public bool $currentlyReorderingStatus = false;

    /**
     * Undocumented variable
     *
     * Entangled in JS
     *
     * @var bool
     */
    // public bool $hideReorderColumnUnlessReorderingStatus = false;

    /**
     * Undocumented variable
     *
     * Entangled in JS
     *
     * @var bool
     */
    // public bool $reorderDisplayColumn = false;

    /**
     * Undocumented variable
     *
     * Retrieved in JS
     *
     * @var string
     */
    // public string $defaultReorderColumn = 'sort';

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $orderedItems = [];

    /**
     * Undocumented variable
     */
    // protected string $reorderMethod = 'reorder';

    /**
     * Undocumented variable
     */
    protected string $defaultReorderDirection = 'asc';

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $reorderConfig = [
        'currentlyReorderingStatus' => false,
        'defaultReorderColumn' => 'sort',
        'reorderStatus' => false,
        'reorderDisplayColumn' => false,

    ];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $reorderDefaultConfig = [
        'currentlyReorderingStatus' => false,
        'defaultReorderDirection' => 'asc',
        'defaultReorderColumn' => 'sort',
        'hideReorderColumnUnlessReorderingStatus' => false,
        'reorderDisplayColumn' => false,
        'reorderMethod' => 'reorder',
        'reorderStatus' => false,
    ];

    /**
     * Undocumented function
     */
    public function enablePaginatedReordering(): void {}

    /**
     * Undocumented function
     */
    public function renderingWithReordering(): void
    {
        $this->setupReordering();
    }
}
