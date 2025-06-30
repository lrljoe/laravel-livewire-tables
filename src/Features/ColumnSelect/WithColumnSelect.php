<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Events\ColumnsSelected;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Configuration\ColumnSelectConfiguration;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Helpers\ColumnSelectHelpers;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\QueryString\HasQueryStringForColumnSelect;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Styling\HasColumnSelectStyling;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Traits\HasColumnSelectSessionStorage;

trait WithColumnSelect
{
    use ColumnSelectConfiguration,
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
     * Determines if Column Select should be in use
     *
     * @var boolean
     */
    protected bool $columnSelectStatus = true;

    /**
     * Sets whether Column Select is Hidden on Mobile
     *
     * @var boolean
     */
    protected bool $columnSelectHiddenOnMobile = false;

    /**
     * Sets whether Column Select is Hidden on Tablet
     *
     * @var boolean
     */
    protected bool $columnSelectHiddenOnTablet = false;

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
        if(!empty($temp) && $temp != "" && $this->selectedColumnsNew != $temp)
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
            $this->storeColumnSelectValues();

            $this->forceSelectedColumnsNew($this->selectedColumns);

            if ($this->getEventStatusColumnSelect()) {
                event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->selectedColumns));
            }
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
        if(!isset($this->selectedColumns))
        {
            $this->selectedColumns = $this->getDefaultVisibleColumns();
        }
        
        if (! $this->getComputedPropertiesStatus()) {
            $view->with([
                'selectedVisibleColumns' => $this->selectedVisibleColumns(),
            ]);
        }
    }
}
