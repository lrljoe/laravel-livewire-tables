<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Core;

use Rappasoft\LaravelLivewireTables\Collections\ColumnCollection;
use Rappasoft\LaravelLivewireTables\Exceptions\NoColumnsException;
use Rappasoft\LaravelLivewireTables\Features\Columns\Core\Configuration\ColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Columns\Core\Helpers\ColumnHelpers;

trait WithColumns
{
    use ColumnConfiguration;
    use ColumnHelpers;

    /**
     * Undocumented variable
     *
     * @var ColumnCollection<int|string,\Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column>
     */
    protected ColumnCollection $columns;

    /**
     * Undocumented variable
     *
     * @var ColumnCollection<int|string,\Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column>|null
     */
    protected ?ColumnCollection $prependedColumns;

    /**
     * Undocumented variable
     *
     * @var ColumnCollection<int|string,\Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column>|null
     */
    protected ?ColumnCollection $appendedColumns;

    /**
     * Undocumented variable
     */
    protected bool $hasRunColumnSetup = false;

    /**
     * Sets up Columns
     */
    public function bootedWithColumns(): void
    {
        $this->columns = new ColumnCollection;

        // Sets Columns
        // Fire Lifecycle Hooks for settingColumns
        $this->callHook('settingColumns');
        $this->callTraitHook('settingColumns');

        // Set Columns
        $this->setColumns();

        // Fire Lifecycle Hooks for columnsSet
        $this->callHook('columnsSet');
        $this->callTraitHook('columnsSet');

        if ($this->columns->count() == 0) {
            throw new NoColumnsException('You must have defined a minimum of one Column for the table to function');
        }

    }

    /**
     * The array defining the columns of the table.
     *
     * @return array<mixed>
     */
    abstract public function columns(): array;

    /**
     * Add Columns to View
     *
     * @param  array<mixed>  $data
     */
    public function renderingWithColumns(\Illuminate\View\View $view, array $data = []): void
    {

        if (! $this->getComputedPropertiesStatus()) {
            $view->with([
                'columns' => $this->getColumns(),
            ]);
        }
    }
}
