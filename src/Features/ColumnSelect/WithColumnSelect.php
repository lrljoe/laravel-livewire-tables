<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Events\ColumnsSelected;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Configuration\ColumnSelectConfiguration;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Helpers\ColumnSelectHelpers;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\QueryString\HasQueryStringForColumnSelect;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Styling\HasColumnSelectStyling;

trait WithColumnSelect
{
    use ColumnSelectConfiguration,
        ColumnSelectHelpers,
        HasQueryStringForColumnSelect,
        HasColumnSelectStyling;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    #[Locked]    
    public array $columnSelectColumns = ['setupRun' => false, 'selected' => [], 'deselected' => [], 'defaultdeselected' => []];

    public mixed $selectedColumnsNew = null;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $selectedColumns = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $deselectedColumns = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $selectableColumns = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $defaultDeselectedColumns = [];

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    #[Locked]
    public bool $excludeDeselectedColumnsFromQuery = false;

    
    /**
     * Undocumented variable
     *
     * @var boolean
     */
    #[Locked]
    public bool $defaultDeselectedColumnsSetup = false;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $columnSelectStatus = true;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $columnSelectHiddenOnMobile = false;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $columnSelectHiddenOnTablet = false;

    public int $columnSelectDelay = 1500;

    protected bool $hasRecentlyUpdated = false;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function bootedWithColumnSelect(): void
    {
        $this->callHook('configuringColumnSelect');
        $this->callTraitHook('configuringColumnSelect');

        $this->setupColumnSelect();

        $this->callHook('configuredColumnSelect');
        $this->callTraitHook('configuredColumnSelect');

        if(!is_null($this->selectedColumnsNew))
        {
            $this->selectedColumns = explode(";",$this->selectedColumnsNew);
        }
    }

    public function updatedSelectedColumnsNew($data)
    {
        $this->selectedColumns = explode(";",$data);
        $this->storeColumnSelectValues();
    }

    public function forceSelectedColumnsNew($data)
    {
        $this->selectedColumnsNew = implode(";",$data);

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function updatedSelectedColumns(): void
    {
        // The query string isn't needed if it's the same as the default
        $this->storeColumnSelectValues();
        $this->forceSelectedColumnsNew($this->selectedColumns);


        if ($this->getEventStatusColumnSelect()) {
            event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->selectedColumns));
        }
    }

    /**
     * Undocumented function
     *
     * @param \Illuminate\View\View $view
     * @param array<mixed> $data
     * @return void
     */
    public function renderingWithColumnSelect(\Illuminate\View\View $view, array $data = []): void
    {
        if (! $this->getComputedPropertiesStatus()) {
            $view->with([
                'selectedVisibleColumns' => $this->selectedVisibleColumns(),
            ]);
        }
    }
}
