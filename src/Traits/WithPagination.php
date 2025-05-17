<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Livewire\Attributes\Locked;
use Livewire\WithPagination as LivewirePagination;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\PaginationConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\PaginationHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\HasPaginationStyling;
use Rappasoft\LaravelLivewireTables\Traits\Core\QueryStrings\HasQueryStringForPagination;

trait WithPagination
{
    use LivewirePagination,
        PaginationConfiguration,
        PaginationHelpers,
        HasQueryStringForPagination,
        HasPaginationStyling;

    /**
     * Undocumented variable
     *
     * @var string|null
     */
    public ?string $pageName = null;

    /**
     * Undocumented variable
     *
     * @var integer|null
     */
    public ?int $perPage;

    /**
     * Undocumented variable
     *
     * @var integer
     */
    #[Locked]
    public int $defaultPerPage = 10;

    
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    #[Locked]
    public array $perPageAccepted = [10, 25, 50];


    /**
     * Undocumented variable
     *
     * @var boolean
     */
    #[Locked]
    public bool $paginationStatus = true;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    #[Locked]
    public bool $paginationVisibilityStatus = true;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    #[Locked]
    public bool $perPageVisibilityStatus = true;

    

    /**
     * Undocumented variable
     *
     * Entangled in JS
     * 
     * @var array<mixed>
     */
    public array $paginationCurrentItems = [];

    /**
     * Undocumented variable
     * 
     * Entangled in JS
     *
     * @var integer
     */
    public int $paginationCurrentCount = 0;

    /**
     * Undocumented variable
     *
     * Entangled in JS
     * 
     * @var integer|null
     */
    public ?int $paginationTotalItemCount = null;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $numberOfPaginatorsRendered = [];

    /**
     * Pagination Method
     * 
     * standard, simple, cursor
     *
     * @var string
     */
    protected string $paginationMethod = 'standard';

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $shouldShowPaginationDetails = true;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $shouldRetrieveTotalItemCount = true;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function mountWithPagination(): void
    {
        $sessionPerPage = session()->get($this->getPerPagePaginationSessionKey(), $this->getPerPage());
        if (! in_array((int) $sessionPerPage, $this->getPerPageAccepted(), false)) {
            $sessionPerPage = $this->getDefaultPerPage();
        }
        $this->setPerPage($sessionPerPage);
    }

    /**
     * Undocumented function
     *
     * @param integer|string $value
     * @return void
     */
    public function updatedPerPage(int|string $value): void
    {
        if (! in_array((int) $value, $this->getPerPageAccepted(), false)) {
            $value = $this->getDefaultPerPage();
        }

        if (in_array(session($this->getPerPagePaginationSessionKey(), (int) $value), $this->getPerPageAccepted(), true)) {
            session()->put($this->getPerPagePaginationSessionKey(), (int) $value);
        } else {
            session()->put($this->getPerPagePaginationSessionKey(), $this->getPerPageAccepted()[0] ?? 10);
        }
        $this->setPerPage($value);
        $this->resetPage($this->getComputedPageName());

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function renderingWithPagination(): void
    {
        $this->setupPagination();
    }
}
