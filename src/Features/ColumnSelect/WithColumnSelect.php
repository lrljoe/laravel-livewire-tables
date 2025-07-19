<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Events\ColumnsSelected;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Configuration\ColumnSelectConfiguration;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Helpers\ColumnSelectHelpers;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\QueryString\HasQueryStringForColumnSelect;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Styling\HasColumnSelectStyling;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Traits\HasColumnSelectSessionStorage;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Concerns\{HandlesColumnSelectStatus, HandlesColumnSelectVisibility};
use Rappasoft\LaravelLivewireTables\Collections\ColumnCollection;

trait WithColumnSelect
{
    use HandlesColumnSelectStatus,
        HandlesColumnSelectVisibility,
        ColumnSelectConfiguration,
        ColumnSelectHelpers,
        HasColumnSelectSessionStorage,
        HasQueryStringForColumnSelect,
        HasColumnSelectStyling;

    /**
     * New Configuration for Column Select
     *
     * @var array<mixed>
     */
    #[Locked]    
    public array $columnSelectColumns = ['setupRun' => false, 'selected' => [], 'deselected' => [], 'defaultdeselected' => []];

    /**
     * New selectedColumns approach (in testing)
     *
     * @var mixed
     */
    public mixed $selectedColumnsNew = null;

    /**
     * Array of selected columns
     *
     * @var array<mixed>
     */
    public ?array $selectedColumns;

    /**
     * Array of deselected columns
     *
     * @var array<mixed>
     */
    public array $deselectedColumns = [];

    /**
     * Array of selectable columns
     *
     * @var array<mixed>
     */
    public array $selectableColumns = [];

    /**
     * Array of default deselected columns
     *
     * @var array<mixed>
     */
    public array $defaultDeselectedColumns = [];

    /**
     * Array of selectable columns
     *
     * @var array<mixed>
     */
    public array $selectableColumnsArray = [];


    /**
     * Toggles whether Deselected Columns should be excluded from the Query or not
     *
     * @var boolean
     */
    #[Locked]
    public bool $excludeDeselectedColumnsFromQuery = false;

    
    /**
     * Determines if Default Deselected Setup is Completed
     *
     * @var boolean
     */
    #[Locked]
    public bool $defaultDeselectedColumnsSetup = false;



    /**
     * Sets the delay for Column Select Classic
     *
     * @var integer
     */
    public int $columnSelectDelay = 1500;

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

    /**
     * Array of selectable columns
     *
     * @var array<mixed>
     */
    public array $columnSelectConfig = [];

    public int $selectableColumnCount = 0;

    public function bootWithColumnSelect(): void
    {
    }

    /**
     * Runs after boot is complete to setup the Column Select functions
     *
     * @return void
     */
    public function bootedWithColumnSelect(): void
    {
        //$this->callHook('configuringColumnSelect');
       // $this->callTraitHook('configuringColumnSelect');

        if($this->runSelectUpdates)
        {
            if(!is_null($this->selectedColumnsNew) && !empty($this->selectedColumnsNew))
            {
             //   dd("bootedWithColumnSelect");

                $this->reloading = true;
                $currentCols = $this->selectedColumns;
                $selectedColsNew = explode(";",$this->selectedColumnsNew);

                ksort($currentCols);
                ksort($selectedColsNew);
             //   dd(['currentCols:' => $currentCols, 'selectedColsNew' => $selectedColsNew]);
                
                //$this->selectedColumns = explode(";",$this->selectedColumnsNew);
                //$this->storeColumnSelectValues();
            }
            else
            {
            }


        }
       // $this->callHook('configuredColumnSelect');
       // $this->callTraitHook('configuredColumnSelect');

    }



    /**
     * Runs when selectedColumnsNew is updated
     *
     * @param mixed $data
     * @return void
     */
    public function updatedSelectedColumnsNew($data): void
    {
       // dd("updatedSelectedColumnsNew");
        if($this->runSelectUpdates)
        {
            $this->reloading = true;
            $selectedColumns = explode(";",$data);
            if ($this->selectedColumns != $selectedColumns)
            {
               /* dd([
                    "selected" => $this->selectedColumns,
                    'new' => $selectedColumns
                ]);*/
                $this->selectedColumns = $selectedColumns;
                $this->storeColumnSelectValues();
                if ($this->getEventStatusColumnSelect()) {
                    event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->selectedColumns));
                }

            }
            

        }
    }

    /**
     * Forces selectedColumnsNew setup
     *
     * @param mixed $data
     * @return void
     */
    public function forceSelectedColumnsNew($data)
    {
        $temp = implode(";",$data);
        if(!empty($temp) && $this->selectedColumnsNew != $temp)
        {
            $this->selectedColumnsNew = $temp;
        }

    }

    /**
     * Runs when selecedColumns is updated (to store)
     *
     * @return void
     */
    public function updatedSelectedColumns(): void
    {
       // dd("updatedSelectedColumns");
        if($this->runSelectUpdates)
        {
            $this->storeColumnSelect();
        }
        $this->selectableColumnArray = $this->generateColumnSelect();

    }

    public function storeColumnSelect(): void
    {
        $this->storeColumnSelectValues();

        $this->forceSelectedColumnsNew($this->selectedColumns);

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

        if(empty($this->selectedColumns) && empty($this->getUnSelectableColumns()))
        {
            $this->selectedColumns = $this->getDefaultVisibleColumns();
        }
        /*$columns = new ColumnCollection($this->getPrependedColumns())->concat($this->columns())->concat(collect($this->getAppendedColumns()));
        dd([
            'old' => $this->getSelectableColumns(),
            'new' => $columns->visible()->selectable()->reorder()->values(),
        ]);*/

        $this->selectableColumnCount = count($this->generateColumnSelect());

        /*
        foreach($this->getSelectableColumns() as $column)
        {
            $this->columnSelectConfig[$column->getSlug()] = ['title' => $column->getTitle(), 'selected' => in_array($column->getSlug(), $this->selectedColumns)];
        }*/
      //  $this->generateColumnSelectCount();

        if (! $this->getComputedPropertiesStatus()) {
            $view->with([
                'selectedVisibleColumns' => $this->selectedVisibleColumns(),
            ]);
        }
    }
}
