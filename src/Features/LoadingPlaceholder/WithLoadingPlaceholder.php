<?php

namespace Rappasoft\LaravelLivewireTables\Features\LoadingPlaceholder;

use Rappasoft\LaravelLivewireTables\Features\LoadingPlaceholder\Configuration\LoadingPlaceholderConfiguration;
use Rappasoft\LaravelLivewireTables\Features\LoadingPlaceholder\Helpers\LoadingPlaceholderHelpers;
use Rappasoft\LaravelLivewireTables\Features\LoadingPlaceholder\Styling\HasLoadingPlaceholderStyling;

trait WithLoadingPlaceholder
{
    use LoadingPlaceholderConfiguration,
        LoadingPlaceholderHelpers,
        HasLoadingPlaceholderStyling;

    /**
     * Undocumented variable
     */
    protected bool $displayLoadingPlaceholder = false;

    /**
     * Undocumented variable
     */
    protected string $loadingPlaceholderContent = 'Loading';

    /**
     * Undocumented variable
     */
    protected ?string $loadingPlaceholderBlade = null;

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $data
     */
    public function renderingWithLoadingPlaceholder(\Illuminate\View\View $view, array $data = []): void
    {
        $view->with([
            'loadingPlaceholderDetails' => $this->getLoadingPlaceHolderDetails(),
        ]);
    }
}
