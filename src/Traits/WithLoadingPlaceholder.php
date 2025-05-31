<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\LoadingPlaceholderConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\LoadingPlaceholderHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\HasLoadingPlaceholderStyling;

trait WithLoadingPlaceholder
{
    use LoadingPlaceholderConfiguration,
        LoadingPlaceholderHelpers,
        HasLoadingPlaceholderStyling;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $displayLoadingPlaceholder = false;

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $loadingPlaceholderContent = 'Loading';

    /**
     * Undocumented variable
     *
     * @var string|null
     */
    protected ?string $loadingPlaceholderBlade = null;

    /**
     * Undocumented function
     *
     * @param \Illuminate\View\View $view
     * @param array<mixed> $data
     * @return void
     */
    public function renderingWithLoadingPlaceholder(\Illuminate\View\View $view, array $data = []): void
    {
        $view->with([
            'loadingPlaceholderDetails' => $this->getLoadingPlaceHolderDetails()
        ]);
    }

}
