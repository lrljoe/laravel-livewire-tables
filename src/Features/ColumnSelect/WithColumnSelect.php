<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Events\ColumnsSelected;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Configuration\ColumnSelectConfiguration;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Helpers\ColumnSelectHelpers;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\QueryString\HasQueryStringForColumnSelect;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Styling\HasColumnSelectStyling;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Traits\HasColumnSelectSessionStorage;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Concerns\{HandlesColumnSelectDropdown, HandlesColumnSelectRemembering, HandlesColumnSelectStatus, HandlesColumnSelectVisibility};
use Rappasoft\LaravelLivewireTables\Collections\ColumnCollection;

trait WithColumnSelect
{
    use HandlesColumnSelectDropdown,
        HandlesColumnSelectStatus,
        HandlesColumnSelectVisibility,
        HandlesColumnSelectRemembering,
        ColumnSelectConfiguration,
        ColumnSelectHelpers,
        HasColumnSelectSessionStorage,
        HasQueryStringForColumnSelect,
        HasColumnSelectStyling;

    /**
     * New Configuration for Column Select Config
     *
     * @var array<mixed>
     */
    #[Locked]
    public array $columnSelectConfig = ['setupRun' => false, 'defaultDeselectedColumnsSetup' => false, 'excludeDeselectedColumnsFromQuery' => false, 'columnSelectDelay' => 1500, 'selected' => [], 'deselected' => [], 'defaultdeselected' => [], 'selectableColumns' => [], 'selectableColumnCount' => 0, 'selectedColumnsQsData' => ''];


    /**
     * Array of selected columns
     *
     * @var array<mixed>
     */
    public array $selectedColumns = [];

    /**
     * Determines whether this was recently updated
     *
     * @var boolean
     */
    protected bool $hasRecentlyUpdated = false;

    /**
     * Determines whether to run the Select updates or not
     *
     * @var boolean
     */
    protected bool $runSelectUpdates = false;

    public function mountWithColumnSelect(): void
    {
        if (strlen($this->columnSelectConfig['selectedColumnsQsData']) > 0)
        {
            $selectedColumns = explode(",", $this->columnSelectConfig['selectedColumnsQsData']);
            $this->selectedColumns = empty($selectedColumns) ? $this->getDefaultVisibleColumns() : $selectedColumns;

        }
        else
        {
            $this->selectedColumns = $this->getDefaultVisibleColumns();

        }
    }

    public function bootWithColumnSelect(): void
    {
    }


    public function bootedWithColumnSelect(): void
    {
    }




    /**
     * Runs when selecedColumns is updated (to store)
     *
     * @return void
     */
    public function updatedSelectedColumns(): void
    {
        $this->columnSelectConfig['selected'] = $this->selectedColumns;

        $this->pushToQueryString($this->selectedColumns);
        if($this->runSelectUpdates)
        {
            $this->storeColumnSelect();
        }
    }

    public function storeColumnSelect(): void
    {
        $this->storeColumnSelectValues();

        if ($this->getEventStatusColumnSelect()) {
            event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->selectedColumns));
        }
    }

    /**
     * Pre-Render Setup for ColumnSelect
     *
     * @param \Illuminate\View\View $view
     * @param array<mixed> $data
     * @return void
     */
    public function renderingWithColumnSelect(\Illuminate\View\View $view, array $data = []): void
    {

        if((count($this->selectedColumns) == 0) && ($this->getUnSelectableColumns()->count() == 0))
        {
            $this->selectedColumns = $this->getDefaultVisibleColumns();
        }

        $generateColumnSelect = $this->generateColumnSelect();
        $this->columnSelectConfig['selectableColumns'] = $generateColumnSelect;
        $this->columnSelectConfig['selectableColumnCount'] = count($generateColumnSelect);
        

        if (! $this->getComputedPropertiesStatus()) {
            $view->with([
                'selectedVisibleColumns' => $this->selectedVisibleColumns(),
            ]);
        }
    }
}
