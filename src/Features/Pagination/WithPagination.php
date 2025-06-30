<?php

namespace Rappasoft\LaravelLivewireTables\Features\Pagination;

use Livewire\Attributes\Locked;
use Livewire\WithPagination as LivewirePagination;
use Rappasoft\LaravelLivewireTables\Features\Pagination\Configuration\PaginationConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Pagination\Helpers\PaginationHelpers;
use Rappasoft\LaravelLivewireTables\Features\Pagination\QueryString\HasQueryStringForPagination;
use Rappasoft\LaravelLivewireTables\Features\Pagination\Styling\HasPaginationStyling;

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

   // #[Locked]
    //public int $defaultPerPage = 10;

   // #[Locked]
    //public array $perPageAccepted = [10, 25, 50];


    //#[Locked]
    //public bool $paginationStatus = true;

    //#[Locked]
    //public bool $paginationVisibilityStatus = true;

    //#[Locked]
    //public bool $perPageVisibilityStatus = true;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    #[Locked]
    public array $paginationConfig = [
        'defaultPerPage' => 10,
        'paginationCurrentItems' => [],
        'paginationCurrentCount' => 0,
        'paginationTotalItemCount' => 0,
        'perPageAccepted' => [10, 25, 50],
        'paginationStatus' => true,
        'paginationVisibilityStatus' => true,
        'perPageVisibilityStatus' => true,
        'shouldShowPaginationDetails' => true,
        'shouldRetrieveTotalItemCount' => true,
    ];

    //public array $paginationCurrentItems = [];

    //public int $paginationCurrentCount = 0;

   // public ?int $paginationTotalItemCount = null;

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

    //protected bool $shouldShowPaginationDetails = true;

    //protected bool $shouldRetrieveTotalItemCount = true;

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
                \Illuminate\Support\Facades\Log::error("updatedPerPage");

        if(!$this->reloading)
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
